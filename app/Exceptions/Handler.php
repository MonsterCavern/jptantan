<?php

namespace App\Exceptions;

use Response;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use App\Models\LogError;
use App\Utils\ResponseUtil;

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
        if ($request->is('api/*')) {
            $log = [
              'message'   => $exception->getMessage(),
              'exception' => get_class($exception),
              'file'      => $exception->getFile(),
              'line'      => $exception->getLine(),
              'trace'     => collect($exception->getTrace())->map(function ($trace) {
                  return Arr::except($trace, ['args']);
              })->all(),
            ];
            LogError::create($log);

            // 特殊情況
            if ($exception instanceof ValidationException) {
                return Response::json(ResponseUtil::makeResponse(head(head($exception->errors()))), 403);
            }
        
            if (! config('app.debug')) {
                return Response::json(ResponseUtil::makeResponse(__('error.undefined')), 500);
            }
        }
      
        return parent::render($request, $exception);
    }
}
