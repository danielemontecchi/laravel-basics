<?php

namespace DanieleMontecchi\LaravelBasics\Configurables;

use DanieleMontecchi\LaravelBasics\Contracts\Configurable;
use Illuminate\Support\Facades\Http;

/**
 * Sets a global timeout for all outgoing HTTP client requests.
 *
 * Prevents hanging requests from blocking production workers indefinitely.
 * The config value is the timeout in seconds; set to false to disable.
 */
class HttpClientGlobalTimeout extends Configurable
{
    public function apply(): void
    {
        $timeout = config()->integer('laravel-basics.enable.http_client_global_timeout', 30);
        Http::globalOptions(['timeout' => $timeout]);
    }
}
