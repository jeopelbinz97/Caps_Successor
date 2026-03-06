<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\Cache\Exception\CacheException;

class Handler extends ExceptionHandler
{
    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (AuthenticationException $e, $request) {
            return response()->json([
                'message' => 'Unauthenticated.'
            ], 401);
        });
    }

    public function render($request, Throwable $exception)
    {
        // Handle cache directory issue
        if ($exception instanceof CacheException && str_contains($exception->getMessage(), 'Please provide a valid cache path')) {
            return response()->json([
                'message' => 'Cache directory is missing or not writable. Please ensure bootstrap/cache exists and is writable.'
            ], 500);
        }

        // Return JSON response for API requests
        if ($request->expectsJson()) {
            return response()->json([
                'message' => $exception->getMessage()
            ], $exception->getCode() ?: 500);
        }

        return parent::render($request, $exception);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return response()->json([
            'message' => 'Unauthenticated.'
        ], 401);
    }
}