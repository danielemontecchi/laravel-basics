<?php

namespace DanieleMontecchi\LaravelBasics\Commands;

use Illuminate\Console\Command;

class BasicsSetupCommand extends Command
{
    protected $signature = 'basics:setup';

    protected $description = 'Performs full Laravel Basics setup: tools, code style, hooks, and best practices.';

    public function handle(): int
    {
        $this->info('🔧 Laravel Basics: Environment Setup');

        // Laravel Debugbar
        if ($this->confirm('Install Laravel Debugbar?', true)) {
            exec('composer require barryvdh/laravel-debugbar --dev');
            $this->callSilent('vendor:publish', ['--provider' => 'Barryvdh\\Debugbar\\ServiceProvider']);
            $this->updateConfig('debugbar.php', "'enabled' => env\\('DEBUGBAR_ENABLED', null\\)", "'enabled' => env('DEBUGBAR_ENABLED', env('APP_DEBUG', null))'");
        }

        // Laravel Log Viewer
        if ($this->confirm('Install Laravel Log Viewer?', true)) {
            exec('composer require opcodesio/log-viewer');
            $this->callSilent('vendor:publish', ['--tag' => 'log-viewer-config']);
            $this->updateConfig('log-viewer.php', "'log-viewer'", "'logs'");
        }

        // Laravel IDE Helper
        if ($this->confirm('Install Laravel IDE Helper?', true)) {
            exec('composer require barryvdh/laravel-ide-helper --dev');
            $this->callSilent('ide-helper:generate');
        }

        // Laravel Backup
        if ($this->confirm('Install Laravel Backup?', false)) {
            exec('composer require spatie/laravel-backup');
        }

        // Laravel Ray
        if ($this->confirm('Install Laravel Ray?', false)) {
            exec('composer require spatie/laravel-ray --dev');
        }

        // Security Checker
        if ($this->confirm('Install Laravel Security Checker?', false)) {
            exec('composer require enlightn/laravel-security-checker --dev');
        }

        // Predis
        if ($this->confirm('Install Predis and use it in config/database.php?', false)) {
            exec('composer require predis/predis');
            $this->updateConfig('database.php', "'client' => 'phpredis'", "'client' => 'predis'");
        }

        // PHP-CS-Fixer
        if ($this->confirm('Install PHP-CS-Fixer and publish config?', true)) {
            exec('composer require --dev friendsofphp/php-cs-fixer');
            copy(__DIR__ . '/../../resources/lint/php-cs-fixer.php', base_path('.php-cs-fixer.dist.php'));
        }

        // Peck (env check)
        if ($this->confirm('Install Peck (.env validation)?', true)) {
            exec('composer require --dev acasaccia/peck');
        }

        // PHPStan
        if ($this->confirm('Install PHPStan?', true)) {
            exec('composer require --dev phpstan/phpstan');
        }

        // Git hooks (Husky)
        if ($this->confirm('Setup Husky hooks (pre-commit, pre-push)?', true)) {
            exec('npm install husky --save-dev');
            exec('npx husky install');

            if (!is_dir(base_path('.husky'))) {
                mkdir(base_path('.husky'));
            }

            // Copia script e hook
            if (!is_dir(base_path('.husky/scripts'))) {
                mkdir(base_path('.husky/scripts'), 0755, true);
            }
            copy(__DIR__ . '/../../resources/scripts/check-env-vars.sh', base_path('.husky/scripts/check-env-vars.sh'));
            chmod(base_path('.husky/scripts/check-env-vars.sh'), 0755);

            // Crea hooks
            copy(__DIR__ . '/../../resources/hooks/pre-commit', base_path('.husky/pre-commit'));
            chmod(base_path('.husky/pre-commit'), 0755);

            copy(__DIR__ . '/../../resources/hooks/pre-push', base_path('.husky/pre-push'));
            chmod(base_path('.husky/pre-push'), 0755);

        }

        $this->info('✅ Setup complete!');

        return self::SUCCESS;
    }

    protected function updateConfig(string $file, string $search, string $replace): void
    {
        $path = config_path($file);

        if (!file_exists($path)) {
            $this->warn("⚠️ Config file {$file} not found, skipping.");
            return;
        }

        $contents = file_get_contents($path);
        $contents = preg_replace("/{$search}/", $replace, $contents);
        file_put_contents($path, $contents);
    }
}
