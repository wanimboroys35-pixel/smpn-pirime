<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Default middleware
        $middleware->alias([
            'auth'  => \App\Http\Middleware\Authenticate::class,
            'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,

            // Custom middleware
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'karel' => \App\Http\Middleware\KarelMiddleware::class,
            'role'  => \App\Http\Middleware\RoleMiddleware::class,
        ]);

       

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
