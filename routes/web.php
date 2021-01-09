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

// Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

use Illuminate\Http\Request;

// Route::get('/register', function () {
//     return view('register');
// });

Route::get('/messages', function () {
    return view('messages');
});

Route::post('/register', function (Request $request) {
    #    return view('welcome');

    $input = $request->all();

    App\Message::create($input);

    return redirect('/register');
});

Route::post('/messages', function (Request $request) {
    #    return view('welcome');

    $input = $request->all();

    App\Message::create($input);

    return redirect('/messages');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
