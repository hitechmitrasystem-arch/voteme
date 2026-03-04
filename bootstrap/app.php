<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\VoterMiddleware;

return Application::configure(basePath: dirname(__DIR__))

    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware): void {

        /*
        |--------------------------------------------------------------------------
        | Middleware Aliases
        |--------------------------------------------------------------------------
        */
        $middleware->alias([
            'admin' => AdminMiddleware::class,
            'voter' => VoterMiddleware::class,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Guest Redirect (FIX Route [login] Error)
        |--------------------------------------------------------------------------
        */
        $middleware->redirectGuestsTo(function (Request $request) {

            if ($request->is('admin') || $request->is('admin/*')) {
                return route('admin.login');
            }

            if ($request->is('voter') || $request->is('voter/*')) {
                return route('voter.login');
            }

            return route('home');
        });
    })

    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })

    ->create();