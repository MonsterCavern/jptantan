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

// Route::resource('boketes', 'Translate\\BoketeAPIController');
// Route::resource('translates', 'Translate\\TranslateAPIController');
Route::resource('translates', 'TranslateAPIController');

Route::any('/{all?}', function () {
    return response()->json(['code' => 404, 'message' => 'NOT FOUND']);
})->where(['all' => '.*']);


Route::resource('translates', 'TranslateAPIController');

Route::resource('translates', 'TranslateAPIController');

Route::resource('translates', 'TranslateAPIController');