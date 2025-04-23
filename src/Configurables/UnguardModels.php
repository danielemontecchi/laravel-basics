<?php

namespace DanieleMontecchi\LaravelBasics\Configurables;

use Illuminate\Database\Eloquent\Model;
use DanieleMontecchi\LaravelBasics\Contracts\Configurable;

/**
 * Disables mass assignment protection on all Eloquent models.
 *
 * Allows any attribute to be mass assigned without needing `$fillable`.
 * Useful for seeders, testing, or internal-only projects.
 *
 * ⚠️ Use with caution, especially in public-facing applications.
 */
class UnguardModels extends Configurable
{
    public function apply(): void
    {
        Model::unguard();
    }
}
