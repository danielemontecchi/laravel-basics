<?php

namespace DanieleMontecchi\LaravelBasics\Configurables;

use Illuminate\Support\Facades\Vite;
use DanieleMontecchi\LaravelBasics\Support\Configurable;

class ViteAggressivePrefetching extends Configurable
{
    public function name(): string
    {
        return 'vite_aggressive_prefetching';
    }

    public function apply(): void
    {
        Vite::useAggressivePrefetching();
    }
}
