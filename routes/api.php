<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('boketes', function () {
//     return abort(500);
// });

Route::resource('boketes', 'BoketeAPIController');

Route::any('/{all?}', function () {
    return response()->json(['code' => 404, 'message' => 'NOT FOUND']);
})->where(['all' => '.*']);


Route::resource('boketes', 'BoketeAPIController');

Route::resource('boketes', 'BoketeAPIController');

Route::resource('boketes', 'BoketeAPIController');

Route::resource('boketes', 'BoketeAPIController');

Route::resource('boketes', 'BoketeAPIController');

Route::resource('boketes', 'BoketeAPIController');

Route::resource('boketes', 'BoketeAPIController');

Route::resource('boketes', 'BoketeAPIController');

Route::resource('boketes', 'BoketeAPIController');

Route::resource('boketes', 'BoketeAPIController');

Route::resource('boketes', 'BoketeAPIController');

Route::resource('boketes', 'BoketeAPIController');

Route::resource('boketes', 'BoketeAPIController');

Route::resource('boketes', 'BoketeAPIController');

Route::resource('boketes', 'BoketeAPIController');