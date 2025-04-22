// src/Configurables/SetLocaleConfiguration.php
<?php

namespace DanieleMontecchi\LaravelBasics\Configurables;

use Illuminate\Support\Str;
use Carbon\Carbon;
use DanieleMontecchi\LaravelBasics\Support\Configurable;

class SetLocale extends Configurable
{
    public function name(): string
    {
        return 'set_locale';
    }

    public function apply(): void
    {
        $locale = config('app.locale');
        $formatted = Str::lower($locale) . '_' . Str::upper($locale);

        setlocale(LC_TIME, $formatted);
        Carbon::setLocale($locale);
    }
}
