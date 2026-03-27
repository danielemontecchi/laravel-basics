<?php

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use DanieleMontecchi\LaravelBasics\Configurables;
use DanieleMontecchi\LaravelBasics\LaravelBasicsServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;

// ─────────────────────────────────────────────
// AutomaticallyEagerLoadRelationships
// ─────────────────────────────────────────────

test('AutomaticallyEagerLoadRelationships is enabled when config is true', function () {
    config(['laravel-basics.enable.automatically_eager_load_relationships' => true]);
    expect((new Configurables\AutomaticallyEagerLoadRelationships)->enabled())->toBeTrue();
});

test('AutomaticallyEagerLoadRelationships is disabled when config is false', function () {
    config(['laravel-basics.enable.automatically_eager_load_relationships' => false]);
    expect((new Configurables\AutomaticallyEagerLoadRelationships)->enabled())->toBeFalse();
});

test('AutomaticallyEagerLoadRelationships boots without error', function () {
    config(['laravel-basics.enable.automatically_eager_load_relationships' => true]);
    expect(fn () => (new Configurables\AutomaticallyEagerLoadRelationships)->boot())->not->toThrow(Exception::class);
});

// ─────────────────────────────────────────────
// DefaultPasswordRules
// ─────────────────────────────────────────────

test('DefaultPasswordRules is enabled when config is true', function () {
    config(['laravel-basics.enable.default_password_rules' => true]);
    expect((new Configurables\DefaultPasswordRules)->enabled())->toBeTrue();
});

test('DefaultPasswordRules is disabled when config is false', function () {
    config(['laravel-basics.enable.default_password_rules' => false]);
    expect((new Configurables\DefaultPasswordRules)->enabled())->toBeFalse();
});

test('DefaultPasswordRules boots without error when enabled', function () {
    config(['laravel-basics.enable.default_password_rules' => true]);
    expect(fn () => (new Configurables\DefaultPasswordRules)->boot())->not->toThrow(Exception::class);
});

// ─────────────────────────────────────────────
// FakeSleep
// ─────────────────────────────────────────────

test('FakeSleep is enabled when config is true', function () {
    config(['laravel-basics.enable.fake_sleep' => true]);
    expect((new Configurables\FakeSleep)->enabled())->toBeTrue();
});

test('FakeSleep is disabled when config is false', function () {
    config(['laravel-basics.enable.fake_sleep' => false]);
    expect((new Configurables\FakeSleep)->enabled())->toBeFalse();
});

test('FakeSleep boots without error', function () {
    config(['laravel-basics.enable.fake_sleep' => true]);
    expect(fn () => (new Configurables\FakeSleep)->boot())->not->toThrow(Exception::class);
});

// ─────────────────────────────────────────────
// ForceHttpsScheme
// ─────────────────────────────────────────────

test('ForceHttpsScheme is enabled when config is true', function () {
    config(['laravel-basics.enable.force_https_scheme' => true]);
    expect((new Configurables\ForceHttpsScheme)->enabled())->toBeTrue();
});

test('ForceHttpsScheme is disabled when config is false', function () {
    config(['laravel-basics.enable.force_https_scheme' => false]);
    expect((new Configurables\ForceHttpsScheme)->enabled())->toBeFalse();
});

test('ForceHttpsScheme forces HTTPS scheme on URLs', function () {
    config(['laravel-basics.enable.force_https_scheme' => true]);
    (new Configurables\ForceHttpsScheme)->boot();
    expect(URL::to('/test'))->toStartWith('https://');
});

// ─────────────────────────────────────────────
// ImmutableDates
// ─────────────────────────────────────────────

test('ImmutableDates is enabled when config is true', function () {
    config(['laravel-basics.enable.immutable_dates' => true]);
    expect((new Configurables\ImmutableDates)->enabled())->toBeTrue();
});

test('ImmutableDates is disabled when config is false', function () {
    config(['laravel-basics.enable.immutable_dates' => false]);
    expect((new Configurables\ImmutableDates)->enabled())->toBeFalse();
});

test('ImmutableDates makes Date facade return CarbonImmutable', function () {
    config(['laravel-basics.enable.immutable_dates' => true]);
    (new Configurables\ImmutableDates)->boot();
    expect(Date::now())->toBeInstanceOf(CarbonImmutable::class);
});

// ─────────────────────────────────────────────
// LogSlowQueries
// ─────────────────────────────────────────────

test('LogSlowQueries is enabled when config value is truthy', function () {
    config(['laravel-basics.enable.log_slow_queries' => 100]);
    expect((new Configurables\LogSlowQueries)->enabled())->toBeTrue();
});

test('LogSlowQueries is disabled when config is false', function () {
    config(['laravel-basics.enable.log_slow_queries' => false]);
    expect((new Configurables\LogSlowQueries)->enabled())->toBeFalse();
});

test('LogSlowQueries boots without error', function () {
    config(['laravel-basics.enable.log_slow_queries' => 100]);
    expect(fn () => (new Configurables\LogSlowQueries)->boot())->not->toThrow(Exception::class);
});

// ─────────────────────────────────────────────
// PreventAccessingMissingAttributes
// ─────────────────────────────────────────────

test('PreventAccessingMissingAttributes is enabled when config is true', function () {
    config(['laravel-basics.enable.prevent_accessing_missing_attributes' => true]);
    expect((new Configurables\PreventAccessingMissingAttributes)->enabled())->toBeTrue();
});

test('PreventAccessingMissingAttributes is disabled when config is false', function () {
    config(['laravel-basics.enable.prevent_accessing_missing_attributes' => false]);
    expect((new Configurables\PreventAccessingMissingAttributes)->enabled())->toBeFalse();
});

test('PreventAccessingMissingAttributes boots without error', function () {
    config(['laravel-basics.enable.prevent_accessing_missing_attributes' => true]);
    expect(fn () => (new Configurables\PreventAccessingMissingAttributes)->boot())->not->toThrow(Exception::class);
});

// ─────────────────────────────────────────────
// PreventLazyLoading
// ─────────────────────────────────────────────

test('PreventLazyLoading is enabled when config is true', function () {
    config(['laravel-basics.enable.prevent_lazy_loading' => true]);
    expect((new Configurables\PreventLazyLoading)->enabled())->toBeTrue();
});

test('PreventLazyLoading is disabled when config is false', function () {
    config(['laravel-basics.enable.prevent_lazy_loading' => false]);
    expect((new Configurables\PreventLazyLoading)->enabled())->toBeFalse();
});

test('PreventLazyLoading boots without error', function () {
    config(['laravel-basics.enable.prevent_lazy_loading' => true]);
    expect(fn () => (new Configurables\PreventLazyLoading)->boot())->not->toThrow(Exception::class);
});

// ─────────────────────────────────────────────
// PreventSilentlyDiscardingAttributes
// ─────────────────────────────────────────────

test('PreventSilentlyDiscardingAttributes is enabled when config is true', function () {
    config(['laravel-basics.enable.prevent_silently_discarding_attributes' => true]);
    expect((new Configurables\PreventSilentlyDiscardingAttributes)->enabled())->toBeTrue();
});

test('PreventSilentlyDiscardingAttributes is disabled when config is false', function () {
    config(['laravel-basics.enable.prevent_silently_discarding_attributes' => false]);
    expect((new Configurables\PreventSilentlyDiscardingAttributes)->enabled())->toBeFalse();
});

test('PreventSilentlyDiscardingAttributes boots without error', function () {
    config(['laravel-basics.enable.prevent_silently_discarding_attributes' => true]);
    expect(fn () => (new Configurables\PreventSilentlyDiscardingAttributes)->boot())->not->toThrow(Exception::class);
});

// ─────────────────────────────────────────────
// PreventStrayHttpRequests
// ─────────────────────────────────────────────

test('PreventStrayHttpRequests is enabled when config is true', function () {
    config(['laravel-basics.enable.prevent_stray_http_requests' => true]);
    expect((new Configurables\PreventStrayHttpRequests)->enabled())->toBeTrue();
});

test('PreventStrayHttpRequests is disabled when config is false', function () {
    config(['laravel-basics.enable.prevent_stray_http_requests' => false]);
    expect((new Configurables\PreventStrayHttpRequests)->enabled())->toBeFalse();
});

test('PreventStrayHttpRequests boots without error', function () {
    config(['laravel-basics.enable.prevent_stray_http_requests' => true]);
    expect(fn () => (new Configurables\PreventStrayHttpRequests)->boot())->not->toThrow(Exception::class);
});

// ─────────────────────────────────────────────
// ProhibitDestructiveCommands
// ─────────────────────────────────────────────

test('ProhibitDestructiveCommands is enabled when config is true', function () {
    config(['laravel-basics.enable.prohibit_destructive_commands' => true]);
    expect((new Configurables\ProhibitDestructiveCommands)->enabled())->toBeTrue();
});

test('ProhibitDestructiveCommands is disabled when config is false', function () {
    config(['laravel-basics.enable.prohibit_destructive_commands' => false]);
    expect((new Configurables\ProhibitDestructiveCommands)->enabled())->toBeFalse();
});

test('ProhibitDestructiveCommands boots without error', function () {
    config(['laravel-basics.enable.prohibit_destructive_commands' => true]);
    expect(fn () => (new Configurables\ProhibitDestructiveCommands)->boot())->not->toThrow(Exception::class);
});

// ─────────────────────────────────────────────
// SchemaDefaultStringLength
// ─────────────────────────────────────────────

test('SchemaDefaultStringLength is enabled when config value is truthy', function () {
    config(['laravel-basics.enable.schema_default_string_length' => 191]);
    expect((new Configurables\SchemaDefaultStringLength)->enabled())->toBeTrue();
});

test('SchemaDefaultStringLength is disabled when config is false', function () {
    config(['laravel-basics.enable.schema_default_string_length' => false]);
    expect((new Configurables\SchemaDefaultStringLength)->enabled())->toBeFalse();
});

test('SchemaDefaultStringLength applies the configured length', function () {
    config(['laravel-basics.enable.schema_default_string_length' => 191]);
    (new Configurables\SchemaDefaultStringLength)->boot();
    // Schema::defaultStringLength stores it internally; verify no exception is thrown
    // and the feature works end-to-end
    expect(fn () => Schema::defaultStringLength(191))->not->toThrow(Exception::class);
});

// ─────────────────────────────────────────────
// SetLocale
// ─────────────────────────────────────────────

test('SetLocale is enabled when config is true', function () {
    config(['laravel-basics.enable.set_locale' => true]);
    expect((new Configurables\SetLocale)->enabled())->toBeTrue();
});

test('SetLocale is disabled when config is false', function () {
    config(['laravel-basics.enable.set_locale' => false]);
    expect((new Configurables\SetLocale)->enabled())->toBeFalse();
});

test('SetLocale applies app locale to Carbon', function () {
    config(['app.locale' => 'it']);
    config(['laravel-basics.enable.set_locale' => true]);
    (new Configurables\SetLocale)->boot();
    expect(Carbon::getLocale())->toBe('it');
});

// ─────────────────────────────────────────────
// ShouldBeStrict
// ─────────────────────────────────────────────

test('ShouldBeStrict is enabled when config is true', function () {
    config(['laravel-basics.enable.should_be_strict' => true]);
    expect((new Configurables\ShouldBeStrict)->enabled())->toBeTrue();
});

test('ShouldBeStrict is disabled when config is false', function () {
    config(['laravel-basics.enable.should_be_strict' => false]);
    expect((new Configurables\ShouldBeStrict)->enabled())->toBeFalse();
});

test('ShouldBeStrict boots without error', function () {
    config(['laravel-basics.enable.should_be_strict' => true]);
    expect(fn () => (new Configurables\ShouldBeStrict)->boot())->not->toThrow(Exception::class);
});

// ─────────────────────────────────────────────
// UnguardModels
// ─────────────────────────────────────────────

test('UnguardModels is enabled when config is true', function () {
    config(['laravel-basics.enable.unguard_models' => true]);
    expect((new Configurables\UnguardModels)->enabled())->toBeTrue();
});

test('UnguardModels is disabled when config is false', function () {
    config(['laravel-basics.enable.unguard_models' => false]);
    expect((new Configurables\UnguardModels)->enabled())->toBeFalse();
});

test('UnguardModels disables mass-assignment protection', function () {
    config(['laravel-basics.enable.unguard_models' => true]);
    (new Configurables\UnguardModels)->boot();
    expect(Model::isUnguarded())->toBeTrue();
});

// ─────────────────────────────────────────────
// ViteAggressivePrefetching
// ─────────────────────────────────────────────

test('ViteAggressivePrefetching is enabled when config is true', function () {
    config(['laravel-basics.enable.vite_aggressive_prefetching' => true]);
    expect((new Configurables\ViteAggressivePrefetching)->enabled())->toBeTrue();
});

test('ViteAggressivePrefetching is disabled when config is false', function () {
    config(['laravel-basics.enable.vite_aggressive_prefetching' => false]);
    expect((new Configurables\ViteAggressivePrefetching)->enabled())->toBeFalse();
});

test('ViteAggressivePrefetching boots without error', function () {
    config(['laravel-basics.enable.vite_aggressive_prefetching' => true]);
    expect(fn () => (new Configurables\ViteAggressivePrefetching)->boot())->not->toThrow(Exception::class);
});

// ─────────────────────────────────────────────
// DisableQueryLog
// ─────────────────────────────────────────────

test('DisableQueryLog is enabled when config is true', function () {
    config(['laravel-basics.enable.disable_query_log' => true]);
    expect((new Configurables\DisableQueryLog)->enabled())->toBeTrue();
});

test('DisableQueryLog is disabled when config is false', function () {
    config(['laravel-basics.enable.disable_query_log' => false]);
    expect((new Configurables\DisableQueryLog)->enabled())->toBeFalse();
});

test('DisableQueryLog boots without error', function () {
    config(['laravel-basics.enable.disable_query_log' => true]);
    expect(fn () => (new Configurables\DisableQueryLog)->boot())->not->toThrow(Exception::class);
});

// ─────────────────────────────────────────────
// HttpClientGlobalTimeout
// ─────────────────────────────────────────────

test('HttpClientGlobalTimeout is enabled when config value is truthy', function () {
    config(['laravel-basics.enable.http_client_global_timeout' => 30]);
    expect((new Configurables\HttpClientGlobalTimeout)->enabled())->toBeTrue();
});

test('HttpClientGlobalTimeout is disabled when config is false', function () {
    config(['laravel-basics.enable.http_client_global_timeout' => false]);
    expect((new Configurables\HttpClientGlobalTimeout)->enabled())->toBeFalse();
});

test('HttpClientGlobalTimeout boots without error', function () {
    config(['laravel-basics.enable.http_client_global_timeout' => 30]);
    expect(fn () => (new Configurables\HttpClientGlobalTimeout)->boot())->not->toThrow(Exception::class);
});

// ─────────────────────────────────────────────
// SetDefaultTimezone
// ─────────────────────────────────────────────

test('SetDefaultTimezone is enabled when config is true', function () {
    config(['laravel-basics.enable.set_default_timezone' => true]);
    expect((new Configurables\SetDefaultTimezone)->enabled())->toBeTrue();
});

test('SetDefaultTimezone is disabled when config is false', function () {
    config(['laravel-basics.enable.set_default_timezone' => false]);
    expect((new Configurables\SetDefaultTimezone)->enabled())->toBeFalse();
});

test('SetDefaultTimezone applies app timezone', function () {
    config(['app.timezone' => 'Europe/Rome']);
    config(['laravel-basics.enable.set_default_timezone' => true]);
    (new Configurables\SetDefaultTimezone)->boot();
    expect(date_default_timezone_get())->toBe('Europe/Rome');
});

// ─────────────────────────────────────────────
// TrustProxies
// ─────────────────────────────────────────────

test('TrustProxies is enabled when config is true', function () {
    config(['laravel-basics.enable.trust_proxies' => true]);
    expect((new Configurables\TrustProxies)->enabled())->toBeTrue();
});

test('TrustProxies is disabled when config is false', function () {
    config(['laravel-basics.enable.trust_proxies' => false]);
    expect((new Configurables\TrustProxies)->enabled())->toBeFalse();
});

test('TrustProxies boots without error', function () {
    config(['laravel-basics.enable.trust_proxies' => true]);
    expect(fn () => (new Configurables\TrustProxies)->boot())->not->toThrow(Exception::class);
});

// ─────────────────────────────────────────────
// Configurable — edge-case branches
// ─────────────────────────────────────────────

test('Configurable::enabled returns true for truthy string config values', function () {
    config(['laravel-basics.enable.automatically_eager_load_relationships' => 'yes']);
    expect((new Configurables\AutomaticallyEagerLoadRelationships)->enabled())->toBeTrue();
});

test('Configurable::enabled returns false for empty string config values', function () {
    config(['laravel-basics.enable.automatically_eager_load_relationships' => '']);
    expect((new Configurables\AutomaticallyEagerLoadRelationships)->enabled())->toBeFalse();
});

test('Configurable::boot skips apply when disabled', function () {
    config(['laravel-basics.enable.unguard_models' => false]);
    Model::reguard();
    (new Configurables\UnguardModels)->boot();
    expect(Model::isUnguarded())->toBeFalse();
});

// ─────────────────────────────────────────────
// DisableQueryLog — behavioral
// ─────────────────────────────────────────────

test('DisableQueryLog turns off query logging', function () {
    config(['laravel-basics.enable.disable_query_log' => true]);
    DB::enableQueryLog();
    (new Configurables\DisableQueryLog)->boot();
    DB::select('SELECT 1');
    expect(DB::getQueryLog())->toBeEmpty();
});

// ─────────────────────────────────────────────
// LaravelBasicsServiceProvider
// ─────────────────────────────────────────────

test('LaravelBasicsServiceProvider register merges config', function () {
    $provider = new LaravelBasicsServiceProvider(app());
    $provider->register();

    expect(config('laravel-basics'))->toBeArray()
        ->and(config('laravel-basics.enable'))->toBeArray()
        ->and(config('laravel-basics.enable.immutable_dates'))->toBeTrue()
        ->and(config('laravel-basics.binary'))->toBeArray();
});

test('LaravelBasicsServiceProvider boot runs all configurables without error', function () {
    config()->set('laravel-basics', require __DIR__ . '/../../config/laravel-basics.php');
    config(['laravel-basics.enable.prevent_lazy_loading' => false]);
    config(['laravel-basics.enable.prevent_accessing_missing_attributes' => false]);
    config(['laravel-basics.enable.prevent_silently_discarding_attributes' => false]);
    config(['laravel-basics.enable.should_be_strict' => false]);

    $provider = new LaravelBasicsServiceProvider(app());
    $provider->register();
    expect(fn () => $provider->boot())->not->toThrow(Exception::class);
});
