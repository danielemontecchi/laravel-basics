<?php

namespace DanieleMontecchi\LaravelBasics\Configurables;

use Illuminate\Database\Eloquent\Model;
use DanieleMontecchi\LaravelBasics\Support\Configurable;

class AutomaticallyEagerLoadRelationships extends Configurable
{
    public function name(): string
    {
        return 'automatically_eager_load_relationships';
    }

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
