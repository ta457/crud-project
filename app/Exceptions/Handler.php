<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof ModelNotFoundException) {
            return new JsonResponse([
                'status' => Response::HTTP_NOT_FOUND,
                'message' => $e->getMessage()
            ], Response::HTTP_NOT_FOUND);
        }

        if ($e instanceof NotFoundHttpException) {
            return new JsonResponse([
                'status' => Response::HTTP_NOT_FOUND,
                'message' => 'page not found'
            ], Response::HTTP_NOT_FOUND);
        }
    }
}
