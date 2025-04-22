<?php

namespace DanieleMontecchi\LaravelBasics\Configurables;

use Illuminate\Database\Eloquent\Model;
use DanieleMontecchi\LaravelBasics\Support\Configurable;

class LogQueryWarnings extends Configurable
{
    public function name(): string
    {
        return 'log_query_warnings';
    }

    public function apply(): void
    {
        Model::preventSilentlyDiscardingAttributes(!app()->isProduction());
    }
}
