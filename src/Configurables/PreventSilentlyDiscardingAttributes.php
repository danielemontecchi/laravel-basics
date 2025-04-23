<?php

namespace DanieleMontecchi\LaravelBasics\Configurables;

use Illuminate\Database\Eloquent\Model;
use DanieleMontecchi\LaravelBasics\Contracts\Configurable;

/**
 * Prevents Laravel from silently discarding unknown attributes on models.
 *
 * Ensures that mass-assignment or attribute access involving undefined fields
 * throws an exception instead of failing silently.
 */
class PreventSilentlyDiscardingAttributes extends Configurable
{
    public function apply(): void
    {
        Model::preventSilentlyDiscardingAttributes(!app()->isProduction());
    }
}
