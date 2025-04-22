<?php

namespace DanieleMontecchi\LaravelBasics\Configurables;

use Illuminate\Support\Facades\URL;
use DanieleMontecchi\LaravelBasics\Support\Configurable;

class ForceHttpsScheme extends Configurable
{
    public function name(): string
    {
        return 'force_https_scheme';
    }

    public function apply(): void
    {
        URL::forceHttps();
    }
}
