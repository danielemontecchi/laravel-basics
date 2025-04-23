<?php

namespace DanieleMontecchi\LaravelBasics\Configurables;

use Illuminate\Support\Facades\Http;
use DanieleMontecchi\LaravelBasics\Contracts\Configurable;

/**
 * Prevents real HTTP requests from being made during tests if Http::fake() is not used.
 *
 * Ensures that all HTTP requests in tests are explicitly stubbed or faked.
 * Throws an exception otherwise, protecting against accidental external calls.
 */
class PreventStrayHttpRequests extends Configurable
{
    public function enabled(): bool
    {
        return parent::enabled() && app()->runningUnitTests();
    }

    public function apply(): void
    {
        Http::preventStrayRequests();
    }
}
