<?php

namespace DanieleMontecchi\LaravelBasics\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use function Laravel\Prompts\multiselect;

class BasicsSetupCommand extends Command
{
    protected $signature = 'basics:setup';

    protected $description = 'Performs full Laravel Basics setup: tools, code style, hooks, and best practices.';

    public function handle(): int
    {
        $this->info('💻 LARAVEL BASICS');
        $options = [
            'folio' => 'Laravel Folio: page based routing for Laravel.',
            'octane' => 'Laravel Octane: supercharge your Laravel application\'s performance.',
            'pulse' => 'Laravel Pulse: real-time application performance monitoring tool and dashboard for your Laravel application.',
            'reverb' => 'Laravel Reverb: provides a real-time WebSocket communication backend for Laravel applications.',
        ];
        $selectedKeys = $this->multiSelect('Select the tools you want to install', $options);

        // Laravel Folio
        if (in_array('folio', $selectedKeys)) {
            $this->execShell('composer require laravel/folio');
            $this->callSilent('folio:install');
            $this->line('✅ Laravel Folio installed and configured.');
        }

        // Laravel Octane
        if (in_array('octane', $selectedKeys)) {
            $this->execShell('composer require laravel/octane');
            $this->callSilent('octane:install');
            $this->line('✅ Laravel Octane installed and configured.');
        }

        // Laravel Pulse
        if (in_array('pulse', $selectedKeys)) {
            $this->execShell('composer require laravel/pulse');
            $this->callSilent('vendor:publish', ['--provider', 'Laravel\\Pulse\\PulseServiceProvider']);
            $this->callSilent('migrate');
            $this->callSilent('vendor:publish', ['--tag', 'pulse-config']);
            $this->line('✅ Laravel Pulse installed and configured.');
        }

        // Laravel Reverb
        if (in_array('reverb', $selectedKeys)) {
            $this->execShell('composer require install:broadcasting');
            $this->updateEnvKey('REVERB_APP_ID');
            $this->updateEnvKey('REVERB_APP_KEY');
            $this->updateEnvKey('REVERB_APP_SECRET');
            $this->line('✅ Laravel Reverb installed.');
        }

        $this->line("\n" . Str::repeat('-', 30) . "\n");


        $this->info('🔍 DEBUG');
        $options = [
            'debugbar' => 'Laravel Debugbar: debugbar for Laravel.',
            'log-viewer' => 'Log Viewer: fast and beautiful Log Viewer for Laravel.',
            'ray' => 'Laravel Ray: debug with Ray to fix problems faster in Laravel apps.',
        ];
        $selectedKeys = $this->multiSelect('Select the tools you want to install', $options);

        // Laravel Debugbar
        if (in_array('debugbar', $selectedKeys)) {
            $this->execShell('composer require barryvdh/laravel-debugbar --dev');
            $this->callSilent('vendor:publish', ['--provider' => 'Barryvdh\\Debugbar\\ServiceProvider']);
            $this->updateConfig('debugbar.php', "'enabled' => env\\('DEBUGBAR_ENABLED', null\\)", "'enabled' => env('DEBUGBAR_ENABLED', env('APP_DEBUG', null))");
            $this->line('✅ Laravel Debugbar installed and configured.');
        }

        // Laravel Log Viewer
        if (in_array('log-viewer', $selectedKeys)) {
            $this->execShell('composer require opcodesio/log-viewer');
            $this->callSilent('log-viewer:publish');
            $this->callSilent('vendor:publish', ['--tag' => 'log-viewer-config']);
            $this->updateConfig('log-viewer.php', "'log-viewer'", "'logs'");
            $this->line('✅ Laravel Log Viewer installed and configured.');
        }

        // Laravel Ray
        if (in_array('ray', $selectedKeys)) {
            $this->execShell('composer require spatie/laravel-ray --dev');
            $this->line('✅ Laravel Ray installed.');
        }

        $this->line("\n" . Str::repeat('-', 30) . "\n");


        $this->info('🛡 SECURITY');
        $options = [
            'backup' => 'Laravel Backup: a package to backup your Laravel app.',
            'security-checker' => 'Symfony Security Checker: scan your Laravel app dependencies for known security vulnerabilities.',
        ];
        $selectedKeys = $this->multiSelect('Select the tools you want to install', $options);

        // Laravel Backup
        if (in_array('backup', $selectedKeys)) {
            $this->execShell('composer require spatie/laravel-backup');
            $this->line('✅ Laravel Backup installed.');
        }

        // Security Checker
        if (in_array('security-checker', $selectedKeys)) {
            $this->execShell('composer require enlightn/laravel-security-checker --dev');
            $this->line('✅ Laravel Security Checker installed.');
        }

        $this->line("\n" . Str::repeat('-', 30) . "\n");


        $this->info('🗄️ DATABASE & QUEUES');
        $options = [
            'predis' => 'Predis: a flexible and feature-complete Redis/Valkey client for PHP.',
            'horizon' => 'Laravel Horizon: dashboard and code-driven configuration for Laravel queues.',
        ];
        $selectedKeys = $this->multiSelect('Select the tools you want to install', $options);

        // Predis
        if (in_array('predis', $selectedKeys)) {
            $this->execShell('composer require predis/predis');
            $this->updateConfig('database.php', "'client' => 'phpredis'", "'client' => 'predis'");
            $this->line('✅ Predis installed and configured.');
        }

        // Laravel Horizon
        if (in_array('horizon', $selectedKeys)) {
            $this->execShell('composer require laravel/horizon');
            $this->callSilent('horizon:install');
            $this->line('✅ Laravel Horizon installed and configured.');
        }

        $this->line("\n" . Str::repeat('-', 30) . "\n");


        $this->info('🧹 LINT');
        $options = [
            'php-cs-fixer' => 'PHP-CS-Fixer: a tool to automatically fix PHP Coding Standards issues.',
            'phpstan' => 'PHPStan: PHP Static Analysis Tool - discover bugs in your code without running it.',
            'editorconfig' => 'EditorConfig: helps maintain consistent coding styles for multiple developers.',
        ];
        $selectedKeys = $this->multiSelect('Select the tools you want to install', $options);

        // PHP-CS-Fixer
        $installed_php_cs_fixer = false;
        if (in_array('php-cs-fixer', $selectedKeys)) {
            $this->execShell('composer require --dev friendsofphp/php-cs-fixer');
            File::copy(__DIR__ . '/../../resources/lint/php-cs-fixer.php', base_path('.php-cs-fixer.dist.php'));
            File::copy(__DIR__ . '/../../resources/lint/.lintstagedrc', base_path('.lintstagedrc'));
            $this->line('✅ PHP-CS-Fixer installed and configured.');
            $installed_php_cs_fixer = true;
        }

        // PHPStan
        $installed_phpstan = false;
        if (in_array('phpstan', $selectedKeys)) {
            $this->execShell('composer require --dev phpstan/phpstan');
            $this->line('✅ PHPStan installed.');
            $installed_phpstan = true;
        }

        if (in_array('editorconfig', $selectedKeys)) {
            File::copy(__DIR__ . '/../../resources/lint/.editorconfig', base_path('.editorconfig'));
            $this->line('✅ EditorConfig configured.');
        }

        $this->line("\n" . Str::repeat('-', 30) . "\n");


        $this->info('🧪 TEST');
        $options = [
            'pest' => 'Pest: an elegant PHP testing Framework with a focus on simplicity.',
            'peck' => 'Peck: a powerful CLI tool designed to identify pure wording or spelling (grammar) mistakes in your codebase.',
        ];
        $selectedKeys = $this->multiSelect('Select the tools you want to install', $options);

        // Pest
        $installed_pest = false;
        if (in_array('pest', $selectedKeys)) {
            $this->execShell('composer require --dev pestphp/pest');
            $this->execShell('composer require --dev pestphp/pest-plugin-laravel');
            $this->line('✅ Pest installed.');
            $installed_pest = true;
        }

        // Peck
        $installed_peck = false;
        if (in_array('peck', $selectedKeys)) {
            $this->execShell('composer require --dev peckphp/peck');
            $this->line('✅ Peck installed.');
            $installed_peck = true;
        }

        $this->line("\n" . Str::repeat('-', 30) . "\n");


        $this->info('📁 IDE');
        $options = [
            'ide-helper' => 'Laravel IDE Helper: IDE Helper for Laravel',
            'husky' => 'Husky: improves your commits and more.',
            'gitignore' => 'File gitignore: a standard file specifies for Laravel project.',
        ];
        $selectedKeys = $this->multiSelect('Select the tools you want to install', $options);

        // Laravel IDE Helper
        if (in_array('ide-helper', $selectedKeys)) {
            $this->execShell('composer require barryvdh/laravel-ide-helper --dev');
            $this->callSilent('ide-helper:generate');
            $this->appendToComposerScript('post-update-cmd', '@php artisan ide-helper:generate');
            $this->appendToComposerScript('post-update-cmd', '@php artisan ide-helper:meta');
            $this->line('✅ Laravel IDE Helper installed and configured.');
        }

        // Git hooks (Husky)
        if (in_array('husky', $selectedKeys)) {
            $this->execShell('npm install husky --save-dev');
            $this->execShell('npx husky install');

            if (!is_dir(base_path('.husky')) || !is_dir(base_path('.husky/scripts'))) {
                File::makeDirectory(base_path('.husky/scripts'), 0755, true);
            }

            File::copy(__DIR__ . '/../../resources/scripts/check-env-vars.sh', base_path('.husky/scripts/check-env-vars.sh'));
            chmod(base_path('.husky/scripts/check-env-vars.sh'), 0755);

            // create hook
            $content = "#!/bin/sh\n" .
                "echo \"🔍 Running pre-commit checks...\"\n\n" .
                "# Validate env consistency\n" .
                "bash .husky/scripts/check-env-vars.sh || exit 1\n\n";
            if ($installed_peck) {
                $content .= "# Run Peck (env validation)\n" .
                    "vendor/bin/peck validate || exit 1\n\n";
            }
            if ($installed_php_cs_fixer) {
                $content .= "# Run PHP-CS-Fixer\n" .
                    "vendor/bin/php-cs-fixer fix --dry-run --diff || exit 1\n\n";
            }
            if ($installed_phpstan) {
                $content .= "# Run PHPStan\n" .
                    "vendor/bin/phpstan analyse --level max --no-progress --memory-limit 1G || exit 1\n\n";
            }
            $content .= "echo \"✅ All pre-commit checks passed!\"\n";
            File::put(base_path('.husky/pre-commit'), $content);
            chmod(base_path('.husky/pre-commit'), 0755);

            if ($installed_pest) {
                $content = "#!/bin/sh\n" .
                    "echo \"🚀 Running test suite before push...\"\n" .
                    "vendor/bin/pest || exit 1\n" .
                    "echo \"✅ All tests passed!\"\n";
                File::put(base_path('.husky/pre-push'), $content);
                chmod(base_path('.husky/pre-push'), 0755);
            }

            $this->line('✅ Husky hooks installed and configured.');
        }

        // Gitignore
        if (in_array('gitignore', $selectedKeys)) {
            $content = file_get_contents('https://www.toptal.com/developers/gitignore/api/laravel,symfony,git,node,phpunit,php-cs-fixer,visualstudiocode,sublimetext,phpstorm+all,linux,macos,windows');
            File::put(base_path('.gitignore'), $content);
            $this->line('✅ gitignore configured.');
        }

        $this->info("\n\n🎉🎉🎉 SETUP COMPLETE!!!");

        return self::SUCCESS;
    }

    protected function multiSelect(string $question, array $options = []): array
    {
        return multiselect(
            label: 'Select what you want to install',
            options: $options
        );
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

    protected function updateEnvKey(string $key, string $value = '', string $path = null): void
    {
        $path ??= base_path('.env');

        if (!file_exists($path)) {
            return;
        }

        $env = file_get_contents($path);
        $keyPattern = preg_quote($key, '/');

        if (preg_match("/^{$keyPattern}=.*$/m", $env)) {
            // Replace existing key
            $env = preg_replace("/^{$keyPattern}=.*$/m", "{$key}={$value}", $env);
        } else {
            // Append key at the end
            $env .= PHP_EOL . "{$key}={$value}" . PHP_EOL;
        }

        file_put_contents($path, $env);

        if ($path != '.env.example') {
            $this->updateEnvKey($key, $value, '.env.example');
        }
    }


    protected function appendToComposerScript(string $hook, string $command): void
    {
        $path = base_path('composer.json');

        if (!file_exists($path)) {
            $this->warn('⚠️ composer.json not found.');
            return;
        }

        $composer = json_decode(file_get_contents($path), true);

        if (!isset($composer['scripts'][$hook])) {
            $composer['scripts'][$hook] = [];
        }

        if (!in_array($command, $composer['scripts'][$hook])) {
            $composer['scripts'][$hook][] = $command;
            file_put_contents($path, json_encode($composer, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
//            $this->info("✅ Added '{$command}' to composer script: {$hook}");
//        } else {
//            $this->line("ℹ️ '{$command}' already present in {$hook}");
        }
    }

    protected function execShell(string $command, bool $silent = true): bool|string
    {
        if ($silent) $command .= ' > /dev/null 2>&1';

        return exec($command);
    }

}
