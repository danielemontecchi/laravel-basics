<?php

use DanieleMontecchi\LaravelBasics\Configurables;

// AutomaticallyEagerLoadRelationships

test('AutomaticallyEagerLoadRelationships boots without error', function () {
    config(['laravel-basics.enable.automatically_eager_load_relationships' => true]);
    $configurable = new Configurables\AutomaticallyEagerLoadRelationships;
    expect($configurable->enabled())->toBeTrue()
        ->and(fn() => $configurable->boot())->not->toThrow(Exception::class);
});

// DefaultPasswordRules

test('DefaultPasswordRules boots without error in production', function () {
    config(['app.env' => 'production']);
    config(['laravel-basics.enable.default_password_rules' => true]);
    $configurable = new Configurables\DefaultPasswordRules;
    expect($configurable->enabled())->toBeTrue()
        ->and(fn() => $configurable->boot())->not->toThrow(Exception::class);
});

// FakeSleep

test('FakeSleep boots without error in test environment', function () {
    config(['laravel-basics.enable.fake_sleep' => true]);
    $configurable = new Configurables\FakeSleep;
    expect($configurable->enabled())->toBeTrue()
        ->and(fn() => $configurable->boot())->not->toThrow(Exception::class);
});

// ForceHttpsScheme

test('ForceHttpsScheme boots without error', function () {
    config(['laravel-basics.enable.force_https_scheme' => true]);
    $configurable = new Configurables\ForceHttpsScheme;
    expect($configurable->enabled())->toBeTrue()
        ->and(fn() => $configurable->boot())->not->toThrow(Exception::class);
});

// ImmutableDates

test('ImmutableDates boots without error', function () {
    config(['laravel-basics.enable.immutable_dates' => true]);
    $configurable = new Configurables\ImmutableDates;
    expect($configurable->enabled())->toBeTrue()
        ->and(fn() => $configurable->boot())->not->toThrow(Exception::class);
});

// LogSlowQueries

test('LogSlowQueries boots without error', function () {
    config(['laravel-basics.enable.log_slow_queries' => true]);
    $configurable = new Configurables\LogSlowQueries;
    expect($configurable->enabled())->toBeTrue()
        ->and(fn() => $configurable->boot())->not->toThrow(Exception::class);
});

// PreventAccessingMissingAttributes

test('PreventAccessingMissingAttributes boots without error', function () {
    config(['laravel-basics.enable.prevent_accessing_missing_attributes' => true]);
    $configurable = new Configurables\PreventAccessingMissingAttributes;
    expect($configurable->enabled())->toBeTrue()
        ->and(fn() => $configurable->boot())->not->toThrow(Exception::class);
});

// PreventLazyLoading

test('PreventLazyLoading boots without error', function () {
    config(['laravel-basics.enable.prevent_lazy_loading' => true]);
    $configurable = new Configurables\PreventLazyLoading;
    expect($configurable->enabled())->toBeTrue()
        ->and(fn() => $configurable->boot())->not->toThrow(Exception::class);
});

// PreventSilentlyDiscardingAttributes

test('PreventSilentlyDiscardingAttributes boots without error', function () {
    config(['laravel-basics.enable.prevent_silently_discarding_attributes' => true]);
    $configurable = new Configurables\PreventSilentlyDiscardingAttributes;
    expect($configurable->enabled())->toBeTrue()
        ->and(fn() => $configurable->boot())->not->toThrow(Exception::class);
});

// PreventStrayHttpRequests

test('PreventStrayHttpRequests boots without error', function () {
    config(['laravel-basics.enable.prevent_stray_http_requests' => true]);
    $configurable = new Configurables\PreventStrayHttpRequests;
    expect($configurable->enabled())->toBeTrue()
        ->and(fn() => $configurable->boot())->not->toThrow(Exception::class);
});

// ProhibitDestructiveCommands

test('ProhibitDestructiveCommands boots without error', function () {
    config(['laravel-basics.enable.prohibit_destructive_commands' => true]);
    $configurable = new Configurables\ProhibitDestructiveCommands;
    expect($configurable->enabled())->toBeTrue()
        ->and(fn() => $configurable->boot())->not->toThrow(Exception::class);
});

// SchemaDefaultStringLength

test('SchemaDefaultStringLength boots without error', function () {
    config(['laravel-basics.enable.schema_default_string_length' => 191]);
    $configurable = new Configurables\SchemaDefaultStringLength;
    expect($configurable->enabled())->toBeTrue()
        ->and(fn() => $configurable->boot())->not->toThrow(Exception::class);
});

// SetLocale

test('SetLocale boots without error', function () {
    config(['app.locale' => 'en']);
    config(['laravel-basics.enable.set_locale' => true]);
    $configurable = new Configurables\SetLocale;
    expect($configurable->enabled())->toBeTrue()
        ->and(fn() => $configurable->boot())->not->toThrow(Exception::class);
});

// ShouldBeStrict

test('ShouldBeStrict boots without error', function () {
    config(['laravel-basics.enable.should_be_strict' => true]);
    $configurable = new Configurables\ShouldBeStrict;
    expect($configurable->enabled())->toBeTrue()
        ->and(fn() => $configurable->boot())->not->toThrow(Exception::class);
});

// UnguardModels

test('UnguardModels boots without error', function () {
    config(['laravel-basics.enable.unguard_models' => true]);
    $configurable = new Configurables\UnguardModels;
    expect($configurable->enabled())->toBeTrue()
        ->and(fn() => $configurable->boot())->not->toThrow(Exception::class);
});

// ViteAggressivePrefetching

test('ViteAggressivePrefetching boots without error', function () {
    config(['laravel-basics.enable.vite_aggressive_prefetching' => true]);
    $configurable = new Configurables\ViteAggressivePrefetching;
    expect($configurable->enabled())->toBeTrue()
        ->and(fn() => $configurable->boot())->not->toThrow(Exception::class);
});
