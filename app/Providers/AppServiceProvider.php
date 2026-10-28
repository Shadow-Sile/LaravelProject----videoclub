<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->applyRuntimeEnvironment();
    }

    /**
     * Wasmer Edge caches the configuration at build time, before runtime
     * environment variables exist. Re-apply them so the cached config does not
     * pin build-time defaults (APP_KEY, database credentials, URL, etc.).
     */
    private function applyRuntimeEnvironment(): void
    {
        $strings = [
            'APP_NAME' => 'app.name',
            'APP_ENV' => 'app.env',
            'APP_KEY' => 'app.key',
            'APP_URL' => 'app.url',
            'APP_TIMEZONE' => 'app.timezone',
            'APP_LOCALE' => 'app.locale',
            'APP_FALLBACK_LOCALE' => 'app.fallback_locale',
            'APP_FAKER_LOCALE' => 'app.faker_locale',
            'SESSION_DRIVER' => 'session.driver',
            'SESSION_DOMAIN' => 'session.domain',
            'CACHE_STORE' => 'cache.default',
            'QUEUE_CONNECTION' => 'queue.default',
            'LOG_CHANNEL' => 'logging.default',
            'FILESYSTEM_DISK' => 'filesystems.default',
        ];

        foreach ($strings as $env => $key) {
            $value = env($env);

            if (is_scalar($value) && (string) $value !== '') {
                config([$key => (string) $value]);
            }
        }

        $booleans = [
            'APP_DEBUG' => 'app.debug',
            'SESSION_ENCRYPT' => 'session.encrypt',
            'SESSION_SECURE_COOKIE' => 'session.secure',
        ];

        foreach ($booleans as $env => $key) {
            $value = env($env);

            if (is_bool($value)) {
                config([$key => $value]);
            } elseif (is_scalar($value) && (string) $value !== '') {
                $parsed = filter_var((string) $value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

                if ($parsed !== null) {
                    config([$key => $parsed]);
                }
            }
        }

        $lifetime = env('SESSION_LIFETIME');

        if (is_numeric($lifetime)) {
            config(['session.lifetime' => (int) $lifetime]);
        }

        $connection = env('DB_CONNECTION');

        if (is_string($connection) && $connection !== '') {
            config(['database.default' => $connection]);
        }

        $prefix = 'database.connections.'.config('database.default');

        foreach (['DB_HOST' => 'host', 'DB_PORT' => 'port', 'DB_USERNAME' => 'username', 'DB_PASSWORD' => 'password'] as $env => $key) {
            $value = env($env);

            if (is_scalar($value) && (! is_string($value) || $value !== 'null')) {
                config(["{$prefix}.{$key}" => (string) $value]);
            }
        }

        $database = env('DB_DATABASE');

        if (! is_string($database) || $database === '' || $database === 'null') {
            $database = env('DB_NAME');
        }

        if (is_string($database) && $database !== '' && $database !== 'null') {
            config(["{$prefix}.database" => $database]);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
