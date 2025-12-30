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
        //
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
