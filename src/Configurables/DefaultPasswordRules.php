<?php

namespace DanieleMontecchi\LaravelBasics\Configurables;

use DanieleMontecchi\LaravelBasics\Contracts\Configurable;
use Illuminate\Validation\Rules\Password;

/**
 * Sets global default password validation rules depending on the environment.
 *
 * In production, it requires passwords to be at least 12 characters,
 * not compromised in known data breaches, and with a max of 255 characters.
 * In non-production environments, no default rule is enforced.
 */
class DefaultPasswordRules extends Configurable
{
    public function apply(): void
    {
        Password::defaults(Password::min(12)->max(50)->uncompromised());
    }
}
