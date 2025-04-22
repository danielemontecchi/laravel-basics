<?php

namespace DanieleMontecchi\LaravelBasics\Configurables;

use DanieleMontecchi\LaravelBasics\Support\Configurable;
use Illuminate\Validation\Rules\Password;

class DefaultPasswordRules extends Configurable
{
    public function name(): string
    {
        return 'default_password_rules';
    }

    public function apply(): void
    {
        Password::defaults(fn(): ?Password => app()->isProduction()
            ? Password::min(12)->max(255)->uncompromised()
            : null
        );
    }
}
