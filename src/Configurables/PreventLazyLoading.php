<?php

namespace DanieleMontecchi\LaravelBasics\Configurables;

use Illuminate\Database\Eloquent\Model;
use DanieleMontecchi\LaravelBasics\Contracts\Configurable;

/**
 * Prevents Eloquent from lazy loading relationships in non-production environments.
 *
 * Helps catch performance issues like N+1 queries early during development
 * by throwing exceptions when relationships are not explicitly eager loaded.
 */
class PreventLazyLoading extends Configurable
{
    public function apply(): void
    {
        Model::preventLazyLoading();
    }
}
