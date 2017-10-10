<?php
namespace App\Providers;

use Response;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\JsonResponse;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function boot()
    {
        //
        Response::macro('caps', function ($value) {
            return Response::make(strtoupper($value));
        });

        Response::macro('jsonb', function ($data, $status = 200, $message=[], array $headers = [], $options = JSON_UNESCAPED_UNICODE) {
            if (!$headers) {
                $headers = [
                    'Content-Type' => 'application/json; charset=UTF-8',
                    'charset'      => 'utf-8'
                ];
            }
            $datas['code'] = $status;
            if ($data) {
                $datas['data'] = $data;
            }
            if ($message) {
                $datas['message'] = $message;
            }
            
            return new JsonResponse($datas, $status, $headers, $options);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
