<?php
namespace App\Exceptions;

use Illuminate\Contracts\Container\Container;
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
        return parent::render($request, $e);
    }
}
