<?php

namespace DanieleMontecchi\LaravelBasics\Configurables;

use Illuminate\Database\Eloquent\Model;
use DanieleMontecchi\LaravelBasics\Support\Configurable;

class ShouldBeStrict extends Configurable
{
    public function name(): string
    {
        return 'strict_model_mode';
    }

    public function apply(): void
    {
        Model::shouldBeStrict(!app()->isProduction());
    }
}
