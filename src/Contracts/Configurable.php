<?php

namespace DanieleMontecchi\LaravelBasics\Contracts;

use Illuminate\Support\Str;

abstract class Configurable
{
    abstract public function apply(): void;

    public function enabled(): bool
    {
        return config()->boolean('laravel-basics.'.Str::snake(self::class), true);
    }

    public function boot(): void
    {
        if ($this->enabled()) {
            $this->apply();
        }
    }
}
