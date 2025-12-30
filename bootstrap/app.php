<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

if (isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL'])) {
    $path = '/tmp/storage';
    if (!is_dir($path)) {
        mkdir($path, 0777, true);
    }
    // Also ensure framework/views exists to prevent view compilation errors
    if (!is_dir($path . '/framework/views')) {
        mkdir($path . '/framework/views', 0777, true);
    }
    
    $app->useStoragePath($path);
}

return $app;
