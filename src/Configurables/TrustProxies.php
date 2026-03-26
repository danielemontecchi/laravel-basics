<?php

namespace DanieleMontecchi\LaravelBasics\Configurables;

use DanieleMontecchi\LaravelBasics\Contracts\Configurable;
use Illuminate\Http\Request;

/**
 * Configures trusted proxies for applications running behind load balancers or CDNs.
 *
 * Required for ForceHttpsScheme and correct IP detection to work reliably
 * when the app is behind a reverse proxy. Trusts local loopback addresses by default.
 */
class TrustProxies extends Configurable
{
    public function apply(): void
    {
        Request::setTrustedProxies(
            ['127.0.0.1', '::1'],
            Request::HEADER_X_FORWARDED_FOR |
            Request::HEADER_X_FORWARDED_HOST |
            Request::HEADER_X_FORWARDED_PORT |
            Request::HEADER_X_FORWARDED_PROTO
        );
    }
}
