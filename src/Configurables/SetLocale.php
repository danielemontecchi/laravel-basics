<?php

namespace DanieleMontecchi\LaravelBasics\Configurables;

use Illuminate\Support\Str;
use Carbon\Carbon;
use DanieleMontecchi\LaravelBasics\Contracts\Configurable;

/**
 * Configures the system and Carbon locale based on `app.locale`.
 *
 * Ensures time formatting via setlocale() and Carbon::setLocale()
 * matches the application's current language configuration.
 */
class SetLocale extends Configurable
{
    public function apply(): void
    {
        $locale = config('app.locale');
        $formatted = Str::lower($locale) . '_' . Str::upper($locale);

        setlocale(LC_TIME, $formatted);
        Carbon::setLocale($locale);
    }
}
