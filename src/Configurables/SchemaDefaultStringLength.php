<?php

namespace DanieleMontecchi\LaravelBasics\Configurables;

use Illuminate\Support\Facades\Schema;
use DanieleMontecchi\LaravelBasics\Support\Configurable;

class SchemaDefaultStringLength extends Configurable
{
    public function name(): string
    {
        return 'schema_default_string_length';
    }

    public function apply(): void
    {
        $length = config('laravel-basics.schema_default_string_length', 191);
        Schema::defaultStringLength($length);
    }
}
