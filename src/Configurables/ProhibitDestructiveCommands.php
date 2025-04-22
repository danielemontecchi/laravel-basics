<?php

namespace DanieleMontecchi\LaravelBasics\Configurables;

use DanieleMontecchi\LaravelBasics\Support\Configurable;
use Illuminate\Support\Facades\DB;

class ProhibitDestructiveCommands extends Configurable
{
    public function name(): string
    {
        return 'prohibit_destructive_commands';
    }

    public function apply(): void
    {
        DB::prohibitDestructiveCommands(app()->isProduction());
    }
}
