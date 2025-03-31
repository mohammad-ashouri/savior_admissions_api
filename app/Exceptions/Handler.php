<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $e): \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
    {
        if ($request->expectsJson()) {
            if ($e instanceof AuthenticationException) {
                return response()->json([
                    'message' => 'Token has expired. Please login again.',
                    'status' => 'token_expired'
                ], 401);
            }

            if ($e instanceof NotFoundHttpException) {
                if (str_contains($e->getMessage(), 'login')) {
                    return response()->json([
                        'message' => 'Token has expired. Please login again.',
                        'status' => 'token_expired'
                    ], 401);
                }
            }
        }

        return parent::render($request, $e);
    }
}
