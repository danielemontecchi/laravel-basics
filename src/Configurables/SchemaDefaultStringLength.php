<?php

namespace DanieleMontecchi\LaravelBasics\Configurables;

use Illuminate\Support\Facades\Schema;
use DanieleMontecchi\LaravelBasics\Contracts\Configurable;

/**
 * Sets a default string length for database schema definitions.
 *
 * This is especially useful when using older MySQL versions
 * that have issues with index sizes on utf8mb4 character sets.
 */
class SchemaDefaultStringLength extends Configurable
{
    public function apply(): void
    {
        $length = config()->integer('laravel-basics.enable.schema_default_string_length', 191);
        Schema::defaultStringLength($length);
    }
}
