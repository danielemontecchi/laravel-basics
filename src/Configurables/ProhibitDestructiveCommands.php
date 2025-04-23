<?php

namespace DanieleMontecchi\LaravelBasics\Configurables;

use DanieleMontecchi\LaravelBasics\Contracts\Configurable;
use Illuminate\Support\Facades\DB;

/**
 * Prohibits execution of destructive Artisan commands in production.
 *
 * Prevents commands like `migrate:fresh`, `db:wipe`, or `migrate:reset`
 * from running in a live environment, reducing the risk of data loss.
 */
class ProhibitDestructiveCommands extends Configurable
{
    public function apply(): void
    {
        DB::prohibitDestructiveCommands(app()->isProduction());
    }
}
