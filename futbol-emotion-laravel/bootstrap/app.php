<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        apiPrefix: 'api',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'auth.pin' => \App\Http\Middleware\AuthPin::class,
        ]);

        // Permitir cookies de sesión en las peticiones API
        $middleware->statefulApi();
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Responder con JSON en errores de API
        $exceptions->renderable(function (\Illuminate\Auth\AuthenticationException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json(['error' => 'No autenticado'], 401);
            }
        });
    })->create();
