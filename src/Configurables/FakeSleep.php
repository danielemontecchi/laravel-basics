<?php

namespace DanieleMontecchi\LaravelBasics\Configurables;

use Illuminate\Support\Sleep;
use DanieleMontecchi\LaravelBasics\Support\Configurable;

class FakeSleep extends Configurable
{
    public function name(): string
    {
        return 'fake_sleep';
    }

    public function enabled(): bool
    {
        return parent::enabled() && app()->runningUnitTests();
    }

    public function apply(): void
    {
        Sleep::fake();
    }
}
