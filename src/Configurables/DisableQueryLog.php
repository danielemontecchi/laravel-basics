<?php

namespace DanieleMontecchi\LaravelBasics\Configurables;

use DanieleMontecchi\LaravelBasics\Contracts\Configurable;
use Illuminate\Support\Facades\DB;

/**
 * Disables the Eloquent query log in production environments.
 *
 * The query log accumulates all executed queries in memory and is
 * only useful during debugging. Disabling it in production prevents
 * silent memory growth in long-running processes.
 */
class DisableQueryLog extends Configurable
{
    public function apply(): void
    {
        DB::disableQueryLog();
    }
}
