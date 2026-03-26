<?php

namespace DanieleMontecchi\LaravelBasics\Configurables;

use DanieleMontecchi\LaravelBasics\Contracts\Configurable;

/**
 * Sets the PHP runtime timezone from the `app.timezone` config value.
 *
 * Complements SetLocale to ensure both locale and timezone are consistently
 * applied from the application configuration.
 */
class SetDefaultTimezone extends Configurable
{
    public function apply(): void
    {
        $timezone = config('app.timezone', 'UTC');
        date_default_timezone_set($timezone);
    }
}
