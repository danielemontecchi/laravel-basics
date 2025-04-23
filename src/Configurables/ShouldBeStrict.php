<?php

namespace DanieleMontecchi\LaravelBasics\Configurables;

use Illuminate\Database\Eloquent\Model;
use DanieleMontecchi\LaravelBasics\Contracts\Configurable;

/**
 * Enables strict mode on Eloquent models in non-production environments.
 *
 * When strict mode is enabled, Laravel throws exceptions for undefined
 * attributes, relationships, or unexpected casts, helping catch bugs early.
 */
class ShouldBeStrict extends Configurable
{
    public function apply(): void
    {
        Model::shouldBeStrict(!app()->isProduction());
    }
}
