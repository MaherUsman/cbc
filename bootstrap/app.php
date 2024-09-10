<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'adminAuth' => App\Http\Middleware\AdminAuthenticate::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (NotFoundHttpException $e) {
            if (request()->is('api/*')) {
                return makeResponse('error', 'Route not Found', Response::HTTP_NOT_FOUND);
            }
        });
        $exceptions->render(function (AuthenticationException $e) {
            if (request()->expectsJson()) {
                return makeResponse('error', $e->getMessage(), Response::HTTP_UNAUTHORIZED);
            }
        });
        $exceptions->render(function (ModelNotFoundException $e) {
            if (request()->expectsJson()) {
                return makeResponse('error', 'Model not Found', Response::HTTP_NOT_FOUND);
            }
        });
    })->create();
