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
            'admin'  => \App\Http\Middleware\EnsureUserIsAdmin::class,
            'vendor' => \App\Http\Middleware\EnsureUserIsVendor::class,
        ]);

        $middleware->redirectGuestsTo(fn () => route('login'));
        // NOTE: app/Http/Middleware/RedirectIfAuthenticated.php already IS
        // Laravel's 'guest' middleware (same class name/location as the
        // framework default) — it's auto-wired, no redirectUsersTo() call
        // needed. Passing a middleware class there was invalid: that method
        // expects a route/URL or closure, not a middleware class reference.
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();