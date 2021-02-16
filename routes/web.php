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

// <a href="/users/{{auth()->user()->id}}">{{ auth()->user()->name }}</

Route::get('/login/oauth/github', 'SocialController@redirectToProvider');
Route::get('/login/oauth/github/callback', 'SocialController@handleProviderCallback');

Route::view('/', 'pure.index');
Route::get('/profile', function () {
    $user = auth()->user();
    return view('pure.users.profile', [
      'user' => $user
    ]);
});

Route::resource('users', 'UserController');


// 未知路由導回首頁
Route::view('/{all}', 'pure.index')->where(['all' => '.*']);
