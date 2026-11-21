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
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'pimpinan' => \App\Http\Middleware\Pimpinan::class,
            'apoteker' => \App\Http\Middleware\Apoteker::class,
            'kasir'    => \App\Http\Middleware\Kasir::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();