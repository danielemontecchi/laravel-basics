<?php

namespace DanieleMontecchi\LaravelBasics\Support;

abstract class Configurable
{
    abstract public function name(): string;
    abstract public function apply(): void;

    public function enabled(): bool
    {
        return config("laravel-basics.".$this->name(), true);
    }

    public function boot(): void
    {
        if ($this->enabled()) {
            $this->apply();
        }
    }
}
