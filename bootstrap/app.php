<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Auth;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectUsersTo('/app');
    })
    ->withExceptions(function (Exceptions $exceptions) {

        // Custom exception handler that REPLACES Laravel's default logging
        $exceptions->reportable(function (Throwable $e) {
            $user = Auth::user();

            logger()->error($e->getMessage(), [
                'user_id'   => $user->id ?? null,
                'user_name' => $user->login ?? null,
                'exception' => $e,
            ]);

            return false; // <-- IMPORTANT: prevents Laravel from logging it again
        });
    })
    ->create();
