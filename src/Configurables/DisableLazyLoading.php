<?php

namespace DanieleMontecchi\LaravelBasics\Configurables;

use Illuminate\Database\Eloquent\Model;
use DanieleMontecchi\LaravelBasics\Support\Configurable;

class DisableLazyLoading extends Configurable
{
    public function name(): string
    {
        return 'disable_lazy_loading';
    }

    public function apply(): void
    {
        Model::preventLazyLoading(!app()->isProduction());
    }
}
