<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;
use Illuminate\Session\TokenMismatchException;
//use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Bengels\LaravelEmailExceptions\Exceptions\EmailHandler as ExceptionHandler;

/**
 * Class Handler
 * @package App\Exceptions
 */
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
     * @param Throwable $exception
     * @return void
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * @param Request $request
     * @param Throwable $e
     * @return JsonResponse|RedirectResponse|\Illuminate\Http\Response|Response
     * @throws Throwable
     */
    public function render($request, Throwable $e)
    {
        if ($e instanceof ModelNotFoundException && $request->wantsJson()) {
            return response()->json([
                'error' => 'Resource not found'
            ], 404);
        }
        if ($e instanceof TokenMismatchException) {
            return redirect()
                ->back()
                ->withInput($request->except('password'))
                ->with([
                    'status' => 'Oops! Your Validation Token has expired. Please try again',
                    'alert' => 'danger'])
                ;
        }
        return parent::render($request, $e);
    }
}
