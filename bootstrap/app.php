<?php

use Illuminate\Database\QueryException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (Exception $e) {
            return match (get_class($e)) {
                NotFoundHttpException::class => response()->json(
                    ['error' => __('http-statuses.404')],
                    404
                ),

                MethodNotAllowedHttpException::class => response()->json(
                    ['error' => __('http-statuses.405')],
                    405
                ),

                AccessDeniedHttpException::class => response()->json([
                    'error' => __('http-statuses.403'),
                ], 403),

                ValidationException::class => response()->json(
                    [
                        'error' => __('http-statuses.400'),
                        'messages' => $e->errors()
                    ],
                    400
                ),

                QueryException::class => response()->json(
                    ['error' => __('http-statuses.500') . $e->getMessage()],
                    500
                ),

                default => response()->json([
                    'error' => app()->environment('production') ? __(
                        'http-statuses.500'
                    ) : $e->getMessage(),
                ], 500)
            };
        });
    })->create();
