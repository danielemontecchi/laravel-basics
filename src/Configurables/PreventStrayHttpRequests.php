<?php

namespace DanieleMontecchi\LaravelBasics\Configurables;

use DanieleMontecchi\LaravelBasics\Contracts\Configurable;
use Illuminate\Support\Facades\Http;

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
        return true;
    }

    public function apply(): void
    {
        if (config()->boolean('laravel-basics.prevent_stray_http_requests', true)) {
            Http::preventStrayRequests();
        } else {
            Http::allowStrayRequests();
        }
    }
}
