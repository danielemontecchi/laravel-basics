<?php

namespace DanieleMontecchi\LaravelBasics;

use Illuminate\Support\ServiceProvider;

class LaravelBasicsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/laravel-basics.php', 'laravel-basics');

        $this->publishes([
            __DIR__ . '/../config/laravel-basics.php' => config_path('laravel-basics.php'),
        ], 'laravel-basics-config');
    }

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