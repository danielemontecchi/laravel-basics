<?php

namespace DanieleMontecchi\LaravelBasics\Configurables;

use Illuminate\Database\Eloquent\Model;
use DanieleMontecchi\LaravelBasics\Support\Configurable;

class UnguardModels extends Configurable
{
    public function name(): string
    {
        return 'unguard_models';
    }

    public function apply(): void
    {
        Model::unguard();
    }
}
