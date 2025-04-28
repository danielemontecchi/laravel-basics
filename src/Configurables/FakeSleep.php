<?php

namespace DanieleMontecchi\LaravelBasics\Configurables;

use Illuminate\Support\Sleep;
use DanieleMontecchi\LaravelBasics\Contracts\Configurable;

/**
 * Fakes Sleep calls during unit tests to avoid real delays.
 *
 * Useful for speeding up test execution when code uses Sleep::for().
 * It is only enabled when running tests, and does nothing otherwise.
 *
 * @see https://laravel.com/docs/testing#sleep-fake
 */
class FakeSleep extends Configurable
{
    public function apply(): void
    {
        Sleep::fake();
    }
}
