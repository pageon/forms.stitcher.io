<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\Request;

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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof ThrottleRequestsException) {
            return $this->handleThrottleRedirect($request, $exception);
        }

        return parent::render($request, $exception);
    }

    private function handleThrottleRedirect(Request $request, ThrottleRequestsException $exception)
    {
        /** @var \App\User|null $user */
        $user = $request->route()->parameter('user');

        if (! $user || ! $user->throttle_redirect_to) {
            return parent::render($request, $exception);
        }

        return redirect()->to($user->throttle_redirect_to);
    }
}
