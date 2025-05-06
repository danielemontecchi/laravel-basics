<?php

return [
    'binary' => [
        'composer' => 'composer',
        'npm' => 'npm',
        'npx' => 'npx',
    ],
    'enable' => [
		'automatically_eager_load_relationships' => true,
		'default_password_rules' => env('APP_ENV') == 'production',
		'fake_sleep' => app()->runningUnitTests(),
		'force_https_scheme' => env('APP_ENV') == 'production',
		'immutable_dates' => true,
		'log_slow_queries' => 100,
		'prevent_accessing_missing_attributes' => env('APP_ENV') != 'production',
		'prevent_lazy_loading' => env('APP_ENV') != 'production',
		'prevent_silently_discarding_attributes' => env('APP_ENV') != 'production',
		'prevent_stray_http_requests' => app()->runningUnitTests(),
		'prohibit_destructive_commands' => env('APP_ENV') == 'production',
		'schema_default_string_length' => 191,
		'set_locale' => true,
		'should_be_strict' => env('APP_ENV') != 'production',
		'unguard_models' => true,
		'vite_aggressive_prefetching' => true,
    ],
];