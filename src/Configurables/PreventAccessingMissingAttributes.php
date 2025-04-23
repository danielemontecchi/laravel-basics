<?php

namespace DanieleMontecchi\LaravelBasics\Configurables;

use Illuminate\Database\Eloquent\Model;
use DanieleMontecchi\LaravelBasics\Contracts\Configurable;

/**
 * Throws exceptions when accessing undefined attributes on Eloquent models.
 *
 * Prevents Laravel from silently ignoring typos or missing columns
 * during model access or mass-assignment.
 */
class PreventAccessingMissingAttributes extends Configurable
{
    public function apply(): void
    {
        Model::preventAccessingMissingAttributes(!app()->isProduction());
    }
}
