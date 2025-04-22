<?php

namespace DanieleMontecchi\LaravelBasics\Configurables;

use Illuminate\Support\Facades\Http;
use DanieleMontecchi\LaravelBasics\Support\Configurable;

class PreventStrayHttpRequests extends Configurable
{
    public function name(): string
    {
        return 'prevent_stray_http_requests';
    }

    public function enabled(): bool
    {
        return parent::enabled() && app()->runningUnitTests();
    }

    public function apply(): void
    {
        Http::preventStrayRequests();
    }
}
