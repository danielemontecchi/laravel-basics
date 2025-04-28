<?php

return [
    'binary' => [
        'composer' => 'composer',
        'npm' => 'npm',
        'npx' => 'npx',
    ],
    'enable' => [
        'automatically_eager_load_relationships' => true,
        'default_password_rules' => app()->isProduction(),
        'fake_sleep' => app()->runningUnitTests(),
        'force_https_scheme' => app()->isProduction(),
        'immutable_dates' => true,
        'log_slow_queries' => 100,
        'prevent_accessing_missing_attributes' => !app()->isProduction(),
        'prevent_lazy_loading' => !app()->isProduction(),
        'prevent_silently_discarding_attributes' => !app()->isProduction(),
        'prevent_stray_http_requests' => app()->runningUnitTests(),
        'prohibit_destructive_commands' => app()->isProduction(),
        'schema_default_string_length' => 191,
        'set_locale' => true,
        'should_be_strict' => !app()->isProduction(),
        'unguard_models' => true,
        'vite_aggressive_prefetching' => true,
    ],
];