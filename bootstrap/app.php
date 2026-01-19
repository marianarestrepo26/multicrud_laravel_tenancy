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
        $middleware->redirectTo(
            guests: '/login',
            users: function ($request) {
                // Si hay un tenant inicializado, ir al panel del tenant
                if (function_exists('tenant') && tenant('id')) {
                    return '/admin';
                }
                // Si no, ir al panel central
                return '/tenants';
            }
        );
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
