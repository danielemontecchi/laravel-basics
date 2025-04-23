<?php

namespace DanieleMontecchi\LaravelBasics\Configurables;

use Illuminate\Support\Facades\Vite;
use DanieleMontecchi\LaravelBasics\Contracts\Configurable;

/**
 * Enables aggressive chunk prefetching when using Vite.
 *
 * Useful for improving perceived performance in Single Page Applications
 * or complex frontend structures with dynamic imports.
 */
class ViteAggressivePrefetching extends Configurable
{
    public function apply(): void
    {
        Vite::useAggressivePrefetching();
    }
}
