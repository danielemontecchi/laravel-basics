# Laravel Basics Package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/danielemontecchi/laravel-basics.svg?style=flat-square)](https://packagist.org/packages/danielemontecchi/laravel-basics)
[![Total Downloads](https://img.shields.io/packagist/dt/danielemontecchi/laravel-basics.svg?style=flat-square)](https://packagist.org/packages/danielemontecchi/laravel-basics)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/danielemontecchi/laravel-basics/tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/danielemontecchi/laravel-basics/actions/workflows/tests.yml)
[![codecov](https://codecov.io/gh/danielemontecchi/laravel-basics/graph/badge.svg?token=X5OFBJO51M)](https://codecov.io/gh/danielemontecchi/laravel-basics)
[![License: MIT](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](LICENSE.md)
[![Documentation](https://img.shields.io/badge/docs-available-brightgreen.svg?style=flat-square)](https://danielemontecchi.github.io/laravel-basics)

A zero-setup package to bootstrap your Laravel projects with a collection of sensible defaults, strict mode helpers, developer protections, and performance tooling. Inspired by [nunomaduro/essentials](https://github.com/nunomaduro/essentials).

## Installation

```bash
composer require danielemontecchi/laravel-basics
```

The package auto-registers via Laravel's service provider discovery.

---

## Configuration

Publish the config file:

```bash
php artisan vendor:publish --tag=laravel-basics-config
```

This will create `config/laravel-basics.php`, where each feature can be individually enabled or disabled.

---

## Available Features

### ✅ AutomaticallyEagerLoadRelationships
Enables automatic eager loading of "touched" relationships in Laravel 10.37+.
Avoids N+1 problems for `$touches` relationships.

### ✅ DefaultPasswordRules
Applies stricter password rules in production (min 12 chars, uncompromised).
No rules enforced in dev/test environments.

### ✅ FakeSleep
Mocks `Sleep::for(...)` in unit tests, avoiding real delays during test execution.

### ✅ ForceHttpsScheme
Forces all generated URLs to use HTTPS — useful behind proxies and CDNs.

### ✅ ImmutableDates
Forces Laravel to use `CarbonImmutable` by default for all date attributes.

### ✅ LogSlowQueries
Logs database queries exceeding a threshold (default: 100ms). Useful for performance auditing.

### ✅ PreventAccessingMissingAttributes
Throws an exception if you try to access a model attribute that doesn't exist.

### ✅ PreventLazyLoading
Throws an exception for lazy-loaded relationships in non-production environments.

### ✅ PreventSilentlyDiscardingAttributes
Throws an exception if unknown attributes are passed to a model via `fill()` or `create()`.

### ✅ PreventStrayHttpRequests
Prevents real HTTP requests from leaking into your test suite if not faked with `Http::fake()`.

### ✅ ProhibitDestructiveCommands
Prevents dangerous Artisan commands like `migrate:fresh`, `db:wipe`, etc. in production.

### ✅ SchemaDefaultStringLength
Sets a default string length for schemas (default: 191), useful for utf8mb4 support on older MySQL.

### ✅ SetLocale
Sets PHP and Carbon locale using the current `app.locale` config value.

### ✅ ShouldBeStrict
Enables strict mode in Eloquent models in non-production environments.
Helps catch unexpected property or relation access.

### ✅ UnguardModels
Disables Laravel mass-assignment protection. Use only in safe environments.

### ✅ ViteAggressivePrefetching
Enables chunk prefetching in Vite to improve load performance.

---

## Contributing

Feel free to fork and contribute by submitting a pull request.

---

## License

This package is open-source software licensed under the [MIT license](LICENSE.md).