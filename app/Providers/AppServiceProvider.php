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
        if (isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL'])) {
            $path = '/tmp/storage';
            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }
            $this->app->useStoragePath($path);
            
            // Ensure view cache path also exists
            if (!is_dir($path . '/framework/views')) {
                mkdir($path . '/framework/views', 0777, true);
            }
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Vercel auto-migration for SQLite demo
        if (!app()->environment('local') && env('DB_CONNECTION') === 'sqlite') {
            $database = config('database.connections.sqlite.database');
            // If the path starts with /tmp, it's ephemeral and we need to recreate it
            if (str_starts_with($database, '/tmp') && !file_exists($database)) {
                touch($database);
                \Illuminate\Support\Facades\Artisan::call('migrate:fresh --force --seed');
            }
        }
    }
}
