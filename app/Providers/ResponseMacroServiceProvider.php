<?php
namespace App\Providers;

use Response;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\JsonResponse;

class ResponseMacroServiceProvider extends ServiceProvider {
    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function boot() {
        //
        Response::macro('caps', function ($value) {
            return Response::make(strtoupper($value));
        });

        Response::macro('jsonb', function ($data, $status = 200, array $headers = [], $options = JSON_UNESCAPED_UNICODE) {
            if (!$headers) {
                $headers = [
                    'Content-Type' => 'application/json; charset=UTF-8',
                    'charset'      => 'utf-8'
                ];
            }
            $data = [
                'code' => $status,
                'data' => $data
            ];
            return new JsonResponse($data, $status, $headers, $options);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }
}
