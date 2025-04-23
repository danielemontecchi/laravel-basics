<?php

namespace DanieleMontecchi\LaravelBasics\Configurables;

use Illuminate\Support\Facades\Date;
use Carbon\CarbonImmutable;
use DanieleMontecchi\LaravelBasics\Contracts\Configurable;

/**
 * Makes all dates returned by Laravel use immutable Carbon instances.
 *
 * This helps prevent accidental date mutation bugs by ensuring
 * all dates behave like value objects (immutable).
 *
 * @see https://laravel.com/docs/master/releases#v8.39.0
 */
class ImmutableDates extends Configurable
{
    public function apply(): void
    {
        Date::use(CarbonImmutable::class);
    }
}
