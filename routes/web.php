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


Route::get('/', function () {
    return view('index');
});

Route::get('/login', function () {
    return view('login');
});

Route::post('/login', 'AuthController@login');


Route::group([
    // 'middleware'    => ['check.roles:admin,vendor'],
    'prefix' => 'admin'
], function () {
    // Dashboard
    Route::get('/', function () {
        return view('admin.index');
    });
    
    Route::any('/{all?}', function () {
        return view('admin.index');
    })->where(['all' => '.*']);
});

Route::any('/{all}', function () {
    return view('index');
})->where(['all' => '.*']);
