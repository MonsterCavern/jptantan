<?php
namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler {
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthenticationException::class,
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        TokenMismatchException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception) {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception) {
        if ($exception instanceof \PDOException) {
            return response()->jsonb([], 200, 'SQL'.$exception->getCode());
        }
        
      
        if ($exception instanceof HttpException) {
            if ($request->is('api/*')) {
                return response()->jsonb([], 404, $exception->getMessage());
            } else {
                //dd($request->path());
                $url = explode('/', $request->path());
                if (count($url) == 1) {
                    $url[1] = 'index';
                }
                $url = implode('.', $url);
                
                if (view()->exists($url)) {
                    return response()->view($url);
                }
            }
            return response()->view('errors.404', [], 404);
        }
        
        if ($exception instanceof ModelNotFoundException) {
            $exception = new NotFoundHttpException($exception->getMessage(), $exception);
        }
   
        return parent::render($request, $exception);
    }

    public function handle($request, Exception $e) {
        # code...
        // if ($e instanceof basicException) {
        //     $data   = $e->toArray();
        //     $status = $e->getStatus();
        // }
        return response()->jsonb([], $e->getCode(), $e->getMessage());
    }
}
