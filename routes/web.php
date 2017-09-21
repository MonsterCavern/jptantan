<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/', function () {
//     return View('home');
// });

Route::group([], function () {
    if (isset($_SERVER['REQUEST_URI'])) {
        $url = '';
        $path = Request::path();
        $request = explode('/', $path);

        foreach ($request as $key => $value) {
            if ($value == '') {
                continue;
            }
            $url .= '/{key'. $key . '?}';
        }

        Route::get($url, function () {
            $view = '';
            $args = func_get_args();
            $url_info = [];
            $index = 0;
            foreach ($args as $k =>$value) {
                if (preg_match('/^([0-9]+)$/', $value)) {
                    $url_info[] = $value;
                    $index += 1;
                } else {
                    $view .= '.' .$value;
                    $url_info[] = $value;
                    $data['filename'] = $value;
                }
            }
            if (!$view) {
                $view = 'home';
            }
            $data['url_info'] = $url_info;
            $view = ltrim($view, '.');
            return view('errors.404', $data);
            //return view('errors.404', $data);
        });

        // $request = explode('/', parse_url($_SERVER['REQUEST_URI'])['path']);
        // $url = '';
        // foreach ($request as $key => $value) {
        //     if ($key == 1) {
        //         continue;
        //     }
        //     $url .= '/{key'. $key . '}';
        // }

        // Route::get($url, function () {
        //     $keys = func_get_args();
        //     $index = 1;
        //     $url = '';
        //     foreach ($keys as $k =>$value) {
        //         if (preg_match('/^([0-9]+)$/', $value)) {
        //             $data['id'.$index] = $value;
        //             $index += 1;
        //         } else {
        //             $url .= '.' .$value;
        //             $data[$value] = $value;
        //         }
        //     }
        //     $url = ltrim($url, '.');
        //     if (view()->exists($url)) {
        //         return view($url, $data);
        //     }
        //     return view('errors.404');
        // });
    }
});
