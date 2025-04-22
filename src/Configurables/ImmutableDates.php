<?php

namespace DanieleMontecchi\LaravelBasics\Configurables;

use Illuminate\Support\Facades\Date;
use Carbon\CarbonImmutable;
use DanieleMontecchi\LaravelBasics\Support\Configurable;

class ImmutableDates extends Configurable
{
    public function name(): string
    {
        return 'immutable_dates';
    }

    public function apply(): void
    {
        Date::use(CarbonImmutable::class);
    }
}
