<?php
use Illuminate\Support\Facades\Route;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('all', 'UrlMapController@index')->middleware('datatable');
Route::post('url', 'UrlMapController@store');
Route::get('autoparser', 'UrlMapController@autoParser');
Route::get('autotranslate', 'UrlMapController@autoTranslate');

Route::get('translate/{id}', 'Translate\TranslateController@show');


Route::any('/{all}', function () {
    return response()->json([
      'code'    => 200,
      'message' => 'not find'
    ]);
})->where(['all' => '.*']);
