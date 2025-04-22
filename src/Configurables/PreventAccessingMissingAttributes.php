<?php

namespace DanieleMontecchi\LaravelBasics\Configurables;

use Illuminate\Database\Eloquent\Model;
use DanieleMontecchi\LaravelBasics\Support\Configurable;

class PreventAccessingMissingAttributes extends Configurable
{
    public function name(): string
    {
        return 'prevent_missing_attributes';
    }

    public function apply(): void
    {
        Model::preventAccessingMissingAttributes(!app()->isProduction());
    }
}
