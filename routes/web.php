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

Auth::routes();

Route::get('/', function () {
    return view('pure.index');
});

Route::view('/login', 'pure.auth.login');

// 未知路由導回首頁
Route::view('/{all}', 'pure.index')->where(['all' => '.*']);
