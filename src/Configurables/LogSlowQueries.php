<?php

namespace DanieleMontecchi\LaravelBasics\Configurables;

use DanieleMontecchi\LaravelBasics\Contracts\Configurable;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\DB;

/**
 * Logs slow database queries that exceed a configurable threshold.
 *
 * Helps identify performance issues during development or staging.
 * Each slow query is logged with its execution time and resolved bindings.
 */
class LogSlowQueries extends Configurable
{
    public function apply(): void
    {
        DB::listen(function (QueryExecuted $event) {
            $threshold = config()->integer('laravel-basics.enable.slow_query_threshold', 100); // ms

            if ($event->time > $threshold) {
                $sql = $event->sql;
                $bindings = $event->bindings;

                foreach ($bindings as $binding) {
                    $value = is_numeric($binding)
                        ? $binding
                        : "'" . addslashes($binding) . "'";
                    $sql = preg_replace('/\\?/', $value, $sql, 1);
                }

                logger()->warning("🐢 Slow Query [{$event->time} ms]\n[query]\n{$sql}");
            }
        });
    }
}
