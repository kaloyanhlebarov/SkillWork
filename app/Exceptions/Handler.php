<?php

namespace App\Exceptions;

use Error;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $e
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $e)
    {
        if($request->wantsJson()) {
            if ($e instanceof AuthenticationException) {
                return response()->json(['error' => 'Unauthenticated!'], 401);
            }

            if ($e instanceof NotFoundHttpException) {
                return response()->json(['error' => 'Not found!'], 404);
            }

            if ($e instanceof ResourceNotFoundException) {
                return response()->json(['error' => 'Resource not found!'], 500);
            }

            if ($e instanceof ModelNotFoundException) {
                return response()->json(['error' => 'Resource not found!'], 404);
            }

            if ($e instanceof MethodNotAllowedException) {
                return response()->json(['error' => 'Method not allowed!'], 405);
            }

            if ($e instanceof ConnectException) {
                return response()->json(['error' => 'Couldnt connect!'], 500);
            }

            if ($e instanceof Error) {
                return response()->json(['error' => 'Server error!'], 500);
            }
        }

        return parent::render($request, $e);
    }
}
