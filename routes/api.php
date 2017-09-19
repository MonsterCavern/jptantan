<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// 以 Contollers 為根目錄, 第一個 segment 為 目錄, 第二個 為 class, 第三個 為 function
Route::group(['middleware'=>'dynamic'], function () {
    if (isset($_SERVER['REQUEST_URI'])) {
        $method     = ucfirst(strtolower($_SERVER['REQUEST_METHOD']));
        $request    = array_slice(explode('/', parse_url($_SERVER['REQUEST_URI'])['path']), 2) ;

        if (!empty($request[0]) && file_exists(app_path('Http/Controllers/').ucfirst($request[0]))) {
            // dir
            $controller = ucfirst($request[0]).'\\';
            $url = $request[0];
            if (file_exists(app_path('Http/Controllers/').ucfirst($url).'/'.ucfirst($request[1]).'Controller.php')) {
                // class
                $controller .= ucfirst($request[1]) . 'Controller';
                $class = 'App\Http\Controllers\\'. $controller;

                if (class_exists($class)) {
                    $url .= '/'.$request[1];
                    $control = new $class;
                    if (isset($request[2])) {
                        if (preg_match('/^([0-9]+)$/', $request[2])) {
                            $func = 'rest'.$method;
                            $request[2] = '{?arg}';
                        } else {
                            $func = 'rest'.$method.'_'.$request[2];
                        }

                        // func
                        if (method_exists($control, $func)) {
                            $url .= '/'.$request[2];
                            $func = $controller . '@' . $func;
                        }
                    } else {
                        $func = $controller . '@' . 'restBulk'.$method;
                    }
                    Route::get($url, $func);
                    Route::post($url, $func);
                    Route::put($url, $func);
                    Route::delete($url, $func);
                }
            }
        }
    }
});

//redirect()->route('home');
