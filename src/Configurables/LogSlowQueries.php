<?php

namespace DanieleMontecchi\LaravelBasics\Configurables;

use DanieleMontecchi\LaravelBasics\Support\Configurable;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\DB;

class LogSlowQueries extends Configurable
{
    public function name(): string
    {
        return 'log_slow_queries';
    }

    public function apply(): void
    {
        DB::listen(function (QueryExecuted $event) {
            $threshold = config('database.slow_query_threshold', 100); // ms

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
