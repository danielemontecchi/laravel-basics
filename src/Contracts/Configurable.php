<?php

namespace DanieleMontecchi\LaravelBasics\Contracts;

use Illuminate\Support\Str;

/**
 * Abstract class `Configurable` that provides a structure for customizable
 * configurations in a Laravel application.
 */
abstract class Configurable
{
    /**
     * Abstract method that must be implemented by child classes.
     * Contains the logic to be applied when the configuration is enabled.
     *
     * @return void
     */
    abstract public function apply(): void;

    /**
     * Checks if the configuration is enabled.
     * Verifies if there is a specific configuration in the project
     * that explicitly disables this functionality.
     *
     * @return bool True if the configuration is enabled, otherwise False.
     */
    public function enabled(): bool
    {
        $className = class_basename(get_class($this));
        $configPath = 'laravel-basics.enable.'.Str::snake($className);
        $configValue = config($configPath, false);

        if (is_bool($configValue)) {
            return $configValue;
        } elseif (is_numeric($configValue)) {
            return intval($configValue)>0;
        } else {
            return boolval($configValue);
        }
    }

    /**
     * Boots the configuration if it is enabled.
     * Calls the `apply` method only if the `enabled` method returns True.
     *
     * @return void
     */
    public function boot(): void
    {
        if ($this->enabled()) {
            $this->apply();
        }
    }
}