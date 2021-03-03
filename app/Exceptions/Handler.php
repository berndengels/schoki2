<?php
namespace App\Exceptions;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
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
}
