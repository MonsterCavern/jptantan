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

//將用戶重新導向至OAuth提供程序
Route::get('login/github', 'Auth\SocialController@redirectToGitHub');
//在身份驗證之後接收來自提供程序的回調。
Route::get('login/github/callback', 'Auth\SocialController@handleGitHubCallback');

Route::get('/', function () {
    return view('pure.index');
});

Route::view('/login', 'pure.auth.login');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('users', 'UserController');
});

// 未知路由導回首頁
Route::view('/{all}', 'pure.index')->where(['all' => '.*']);
