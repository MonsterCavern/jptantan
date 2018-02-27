<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * 註冊該路由的回應巨集。
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('datatable', function ($value) {
            return response()->json([
              'data' => $value,
              'total' => count($value)
            ]);
        });
    }
}
