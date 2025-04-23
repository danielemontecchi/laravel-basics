<?php

namespace DanieleMontecchi\LaravelBasics\Configurables;

use Illuminate\Database\Eloquent\Model;
use DanieleMontecchi\LaravelBasics\Contracts\Configurable;

/**
 * Enables automatic eager loading of "touched" relationships in Laravel 10.37+.
 *
 * This ensures that any relationship listed in a model's `$touches` array
 * is automatically eager loaded to avoid N+1 query issues when updated.
 *
 * It safely checks if the method exists for backwards compatibility.
 *
 * @see https://github.com/laravel/framework/pull/48189
 */
class AutomaticallyEagerLoadRelationships extends Configurable
{
    public function apply(): void
    {
        // Check if the method exists (backward compatibility with Laravel < 10.37)
        if (! method_exists(Model::class, 'automaticallyEagerLoadRelationships')) {
            return;
        }

        // Enable eager loading of touched relationships
        Model::automaticallyEagerLoadRelationships();
    }
}
