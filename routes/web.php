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
    return view('welcome');
});

use Illuminate\Http\Request;

Route::get('/messages', function () {
    return view('messages');
});

Route::get('/register', function () {
    return view('register');
});

Route::post('/messages', function (Request $request) {
    #    return view('welcome');

    $input = $request->all();

    App\Message::create($input);

    return redirect('/messages');
});
