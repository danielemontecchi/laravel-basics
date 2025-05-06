<?php

namespace DanieleMontecchi\LaravelBasics\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use function Laravel\Prompts\multiselect;
use Symfony\Component\Process\Process;

class BasicsSetupCommand extends Command
{
    protected $signature = 'basics:setup';
    protected $description = 'Performs full Laravel Basics setup: tools, code style, hooks, and best practices.';

    public function handle(): int
    {
        $this->info("\n\n********** 💻 LARAVEL BASICS **********");
        $this->configureBasics();
        $this->info("\n\n********** 🔍 DEBUG **********");
        $this->configureDebug();
        $this->info("\n\n********** 🛡 SECURITY **********");
        $this->configureSecurity();
        $this->info("\n\n********** 🗄️ DATABASE & QUEUES **********");
        $this->configureDatabaseQueues();
        $this->info("\n\n********** 🧹 LINT **********");
        $this->configureLint();
        $this->info("\n\n**********  🧪 TEST  **********");
        $this->configureTest();
        $this->info("\n\n********** 📁 IDE **********");
        $this->configureIde();

        $this->info("\n\n************************************************");
        $this->info("**********   🎉🎉🎉 SETUP COMPLETE   **********");
        $this->info("************************************************");

        return self::SUCCESS;
    }

    protected function configureBasics(): void
    {
        $options = [
            'folio' => 'Laravel Folio: page based routing for Laravel.',
            'octane' => 'Laravel Octane: supercharge your Laravel application\'s performance.',
            'pulse' => 'Laravel Pulse: real-time application performance monitoring tool and dashboard for your Laravel application.',
            'reverb' => 'Laravel Reverb: provides a real-time WebSocket communication backend for Laravel applications.',
        ];
        $selectedKeys = $this->multiSelect($options);

        // Laravel Folio
        if (in_array('folio', $selectedKeys)) {
            $this->runShell('composer require laravel/folio');
            $installed = $this->callIfAvailable('folio:install', [], \Laravel\Folio\FolioServiceProvider::class);
            if ($installed) {
                $this->line('✅ Laravel Folio installed and configured.');
            } else {
                $this->warn('⚠️ Laravel Folio installed but not yet available, please run "php artisan folio:install" manually.');
            }
        }

        // Laravel Octane
        if (in_array('octane', $selectedKeys)) {
            $this->runShell('composer require laravel/octane');
            $installed = $this->callIfAvailable('octane:install', [], \Laravel\Octane\OctaneServiceProvider::class);
            if ($installed) {
                $this->line('✅ Laravel Octane installed and configured.');
            } else {
                $this->warn('⚠️ Laravel Octane installed but not yet available, please run "php artisan octane:install" manually.');
            }
        }

        // Laravel Pulse
        if (in_array('pulse', $selectedKeys)) {
            $this->runShell('composer require laravel/pulse');
            $this->callSilently('vendor:publish', ['--provider', 'Laravel\\Pulse\\PulseServiceProvider']);
            $this->callSilently('migrate');
            $this->callSilently('vendor:publish', ['--tag', 'pulse-config']);
            $this->line('✅ Laravel Pulse installed and configured.');
        }

        // Laravel Reverb
        if (in_array('reverb', $selectedKeys)) {
            $this->runShell('composer require install:broadcasting');
            $this->addEnvKey('REVERB_APP_ID');
            $this->addEnvKey('REVERB_APP_KEY');
            $this->addEnvKey('REVERB_APP_SECRET');
            $this->line('✅ Laravel Reverb installed.');
        }


    }

    protected function configureDebug(): void
    {
        $options = [
            'debugbar' => 'Laravel Debugbar: debugbar for Laravel.',
            'log' => 'Log Viewer: fast and beautiful Log Viewer for Laravel.',
            'ray' => 'Laravel Ray: debug with Ray to fix problems faster in Laravel apps.',
        ];
        $selectedKeys = $this->multiSelect($options);

        // Laravel Debugbar
        if (in_array('debugbar', $selectedKeys)) {
            $this->runShell('composer require barryvdh/laravel-debugbar --dev');
            $this->callSilently('vendor:publish', ['--provider' => 'Barryvdh\\Debugbar\\ServiceProvider']);
            $this->updateConfig('debugbar.php', "'enabled' => env\\('DEBUGBAR_ENABLED', null\\)", "'enabled' => env('DEBUGBAR_ENABLED', env('APP_DEBUG', null))");
            $this->line('✅ Laravel Debugbar installed and configured.');
        }

        // Laravel Log Viewer
        if (in_array('log', $selectedKeys)) {
            $this->runShell('composer require opcodesio/log-viewer');
            $this->callSilently('vendor:publish', ['--tag' => 'log-viewer-config']);
            $this->updateConfig('log-viewer.php', "'log-viewer'", "'logs'");
            $installed = $this->callIfAvailable('log-viewer:publish', [], \Opcodes\LogViewer\LogViewerServiceProvider::class);
            if ($installed) {
                $this->line('✅ Laravel Log Viewer installed and configured.');
            } else {
                $this->warn('⚠️ Laravel Log Viewer installed but not yet available, please run "php artisan log-viewer:publish" manually.');
            }
        }

        // Laravel Ray
        if (in_array('ray', $selectedKeys)) {
            $this->runShell('composer require spatie/laravel-ray --dev');
            $this->line('✅ Laravel Ray installed.');
        }
    }

    protected function configureSecurity(): void
    {
        $options = [
            'backup' => 'Laravel Backup: a package to backup your Laravel app.',
            'security' => 'Symfony Security Checker: scan your Laravel app dependencies for known security vulnerabilities.',
        ];
        $selectedKeys = $this->multiSelect($options);

        // Laravel Backup
        if (in_array('backup', $selectedKeys)) {
            $this->runShell('composer require spatie/laravel-backup');
            $this->line('✅ Laravel Backup installed.');
        }

        // Security Checker
        if (in_array('security', $selectedKeys)) {
            $this->runShell('composer require enlightn/laravel-security-checker --dev');
            $this->line('✅ Laravel Security Checker installed.');
        }


    }

    protected function configureDatabaseQueues(): void
    {
        $options = [
            'predis' => 'Predis: a flexible and feature-complete Redis/Valkey client for PHP.',
            'horizon' => 'Laravel Horizon: dashboard and code-driven configuration for Laravel queues.',
        ];
        $selectedKeys = $this->multiSelect($options);

        // Predis
        if (in_array('predis', $selectedKeys)) {
            $this->runShell('composer require predis/predis');
            $this->updateConfig('database.php', "'client' => 'phpredis'", "'client' => 'predis'");
            $this->line('✅ Predis installed and configured.');
        }

        // Laravel Horizon
        if (in_array('horizon', $selectedKeys)) {
            $this->runShell('composer require laravel/horizon');
            $installed = $this->callIfAvailable('horizon:install', [], \Laravel\Horizon\HorizonServiceProvider::class);
            if ($installed) {
                $this->line('✅ Laravel Horizon installed and configured.');
            } else {
                $this->warn('⚠️ Laravel Horizon installed but not yet available, please run "php artisan horizon:install" manually.');
            }
        }

    }

    protected function configureLint(): void
    {
        $options = [
            'phpcsf' => 'PHP-CS-Fixer: a tool to automatically fix PHP Coding Standards issues.',
            'phpstan' => 'PHPStan: PHP Static Analysis Tool - discover bugs in your code without running it.',
            'editor' => 'EditorConfig: helps maintain consistent coding styles for multiple developers.',
        ];
        $selectedKeys = $this->multiSelect($options);

        // PHP-CS-Fixer
        if (in_array('phpcsf', $selectedKeys)) {
            $this->runShell('composer require --dev friendsofphp/php-cs-fixer');
            File::copy(__DIR__ . '/../../resources/lint/php-cs-fixer.php', base_path('.php-cs-fixer.dist.php'));
            File::copy(__DIR__ . '/../../resources/lint/.lintstagedrc', base_path('.lintstagedrc'));
            $this->line('✅ PHP-CS-Fixer installed and configured.');
        }

        // PHPStan
        if (in_array('phpstan', $selectedKeys)) {
            $this->runShell('composer require --dev phpstan/phpstan');
            $this->line('✅ PHPStan installed.');
        }

        if (in_array('editor', $selectedKeys)) {
            File::copy(__DIR__ . '/../../resources/lint/.editorconfig', base_path('.editorconfig'));
            $this->line('✅ EditorConfig configured.');
        }

    }

    protected function configureTest(): void
    {
        $options = [
            'pest' => 'Pest: an elegant PHP testing Framework with a focus on simplicity.',
            'peck' => 'Peck: a powerful CLI tool designed to identify pure wording or spelling (grammar) mistakes in your codebase.',
        ];
        $selectedKeys = $this->multiSelect($options);

        // Pest
        if (in_array('pest', $selectedKeys)) {
            $this->runShell('composer require --dev pestphp/pest');
            $this->runShell('composer require --dev pestphp/pest-plugin-laravel');
            $this->line('✅ Pest installed.');
        }

        // Peck
        if (in_array('peck', $selectedKeys)) {
            $this->runShell('composer require --dev peckphp/peck');
            $this->line('✅ Peck installed.');
        }

    }

    protected function configureIde(): void
    {
        $options = [
            'ide' => 'Laravel IDE Helper: IDE Helper for Laravel',
            'husky' => 'Husky: improves your commits and more.',
            'gitignore' => 'File gitignore: a standard file specifies for Laravel project.',
        ];
        $selectedKeys = $this->multiSelect($options);

        // Laravel IDE Helper
        if (in_array('ide', $selectedKeys)) {
            $this->runShell('composer require barryvdh/laravel-ide-helper --dev');
            $this->appendToComposerScript('post-update-cmd', '@php artisan ide-helper:generate');
            $this->appendToComposerScript('post-update-cmd', '@php artisan ide-helper:meta');
            $installed = $this->callIfAvailable('ide-helper:generate', [], \Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            if ($installed) {
                $this->line('✅ Laravel IDE Helper installed and configured.');
            } else {
                $this->warn('⚠️ Laravel IDE Helper installed but not yet available, please run "php artisan ide-helper:generate" manually.');
            }
        }

        // Git hooks (Husky)
        if (in_array('husky', $selectedKeys)) {
            $this->runShell('npm install --save-dev husky');
            $this->runShell('npx husky init');

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
            if ($this->isBinaryAvailable('peck')) {
                $content .= "# Run Peck (env validation)\n" .
                    "vendor/bin/peck validate || exit 1\n\n";
            }
            if ($this->isBinaryAvailable('php-cs-fixer')) {
                $content .= "# Run PHP-CS-Fixer\n" .
                    "vendor/bin/php-cs-fixer fix --dry-run --diff || exit 1\n\n";
            }
            if ($this->isBinaryAvailable('phpstan')) {
                $content .= "# Run PHPStan\n" .
                    "vendor/bin/phpstan analyse --level max --no-progress --memory-limit 1G || exit 1\n\n";
            }
            $content .= "echo \"✅ All pre-commit checks passed!\"\n";
            File::put(base_path('.husky/pre-commit'), $content);
            chmod(base_path('.husky/pre-commit'), 0755);

            if ($this->isBinaryAvailable('pest')) {
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
            $content = "# DEFAULT LARAVEL\n" .
                "/public/build\n" .
                "/storage/pail\n" .
                ".env.backup\n" .
                ".env.production\n" .
                ".phpactor.json\n" .
                "/auth.json\n" .
                "/.nova\n" .
                "/.zed\n" .
                "\n" .
                $content;
            File::put(base_path('.gitignore'), $content);
            $this->line('✅ gitignore configured.');
        }

    }

    protected function multiSelect(array $options): array
    {
        return multiselect(
            label: 'Select what you want to install',
            options: $options
        );
    }

    protected function updateConfig(string $file, string $search, string $replace): void
    {
        $path = config_path($file);

        if (!File::exists($path)) {
            $this->warn("⚠️ Config file {$file} not found, skipping.");
            return;
        }

        $contents = file_get_contents($path);
        $contents = preg_replace("/{$search}/", $replace, $contents);
        File::put($path, $contents);
    }

    protected function addEnvKey(string $key, string $value = '', string $path = null): void
    {
        $path ??= base_path('.env');

        if (!file_exists($path)) {
            return;
        }

        $env = file_get_contents($path);
        $keyPattern = preg_quote($key, '/');

        if (!preg_match("/^{$keyPattern}=.*$/m", $env)) {
            // Append key at the end
            $env .= PHP_EOL . "{$key}={$value}" . PHP_EOL;
//        } else {
//            // Replace existing key
//            $env = preg_replace("/^{$keyPattern}=.*$/m", "{$key}={$value}", $env);
        }

        file_put_contents($path, $env);

        if ($path != '.env.example') {
            $this->addEnvKey($key, $value, '.env.example');
        }
    }

    protected function isBinaryAvailable(string $binary): bool
    {
        return File::exists(base_path('vendor/bin/' . $binary));
    }

    protected function appendToComposerScript(string $hook, string $command): void
    {
        $path = base_path('composer.json');

        if (!File::exists($path)) {
            $this->warn('⚠️ composer.json not found.');
            return;
        }

        $composer = json_decode(file_get_contents($path), true);

        if (!isset($composer['scripts'][$hook])) {
            $composer['scripts'][$hook] = [];
        }

        if (!in_array($command, $composer['scripts'][$hook])) {
            $composer['scripts'][$hook][] = $command;
            File::put($path, json_encode($composer, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
//            $this->info("✅ Added '{$command}' to composer script: {$hook}");
//        } else {
//            $this->line("ℹ️ '{$command}' already present in {$hook}");
        }
    }

    protected function runShell(string $command, bool $silent = true): bool
    {
        $isComposer = false;
        if (Str::startsWith($command, 'composer ')) {
            $command = Str::replace('composer ', Str::finish(config('laravel-basics.binary.composer', 'composer'), ' '), $command);
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                $command .= ' --ignore-platform-req=*';
            }
            $isComposer = true;
        }
        if (Str::startsWith($command, 'npm ')) {
            $command = Str::replace('npm ', Str::finish(config('laravel-basics.binary.npm', 'npm'), ' '), $command);
        }
        if (Str::startsWith($command, 'npx ')) {
            $command = Str::replace('npx ', Str::finish(config('laravel-basics.binary.npx', 'npx'), ' '), $command);
        }

        $process = Process::fromShellCommandline($command, base_path());

        if ($silent) {
            $process->run();
        } else {
            $process->run(function ($type, $buffer) {
                echo $buffer;
            });
        }
        if ($isComposer) {
            $processDump = Process::fromShellCommandline('composer dumpautoload', base_path());
            $processDump->run();
            sleep(2);
        }

        return $process->isSuccessful();
    }

    /**
     * Call an Artisan command only if the given class exists (i.e., the package is properly loaded).
     *
     * @param string $command The Artisan command to call (e.g., 'ide-helper:generate')
     * @param array $params Optional parameters to pass to the command
     * @param string|null $checkClass Optional fully qualified class name to check before calling
     * @return bool True if executed, false otherwise
     */
    protected function callIfAvailable(string $command, array $params = [], ?string $checkClass = null): bool
    {
        // If a check class is provided, ensure it exists before calling the command
        if ($checkClass && !class_exists($checkClass)) {
//        $this->warn("⏭  Command '$command' skipped: class $checkClass not loaded.");
            return false;
        }

        try {
            $this->callSilent($command, $params);
//        $this->info("✅ Command '$command' executed successfully.");
            return true;
        } catch (\Exception $e) {
//        $this->warn("⚠️  Failed to execute '$command': " . $e->getMessage());
            return false;
        }
    }

}
