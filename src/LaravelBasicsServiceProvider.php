<?php

namespace DanieleMontecchi\LaravelBasics;

use Illuminate\Support\ServiceProvider;

/**
 * Service provider for the Laravel Basics package.
 * Handles the registration and bootstrapping of package services and configurations.
 */
class LaravelBasicsServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     * Merges the package configuration file with the application's configuration
     * and defines the publishable resources for the package.
     *
     * @return void
     */
    public function register(): void
    {
        // Merge the package configuration file with the application's configuration.
        $this->mergeConfigFrom(__DIR__ . '/../config/laravel-basics.php', 'laravel-basics');

        // Define the publishable configuration file for the package.
        $this->publishes([
            __DIR__ . '/../config/laravel-basics.php' => config_path('laravel-basics.php'),
        ], 'laravel-basics-config');
    }

    /**
     * Bootstrap any application services.
     * Iterates through a list of configurable classes and calls their `boot` method.
     *
     * @return void
     */
    public function boot(): void
    {
        collect([
            Configurables\AutomaticallyEagerLoadRelationships::class,
            Configurables\DefaultPasswordRules::class,
            Configurables\PreventLazyLoading::class,
            Configurables\FakeSleep::class,
            Configurables\ForceHttpsScheme::class,
            Configurables\ImmutableDates::class,
            Configurables\PreventSilentlyDiscardingAttributes::class,
            Configurables\LogSlowQueries::class,
            Configurables\PreventAccessingMissingAttributes::class,
            Configurables\PreventStrayHttpRequests::class,
            Configurables\ProhibitDestructiveCommands::class,
            Configurables\SchemaDefaultStringLength::class,
            Configurables\SetLocale::class,
            Configurables\ShouldBeStrict::class,
            Configurables\UnguardModels::class,
            Configurables\ViteAggressivePrefetching::class,
        ])->each->boot();
    }
}