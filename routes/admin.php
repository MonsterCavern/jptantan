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


Route::group([
    'middleware'    => ['check.roles'],
], function () {
    Route::resource('admins', 'API\AdminAPIController');
    Route::resource('users', 'UserAPIController');
    Route::resource('roles', 'RoleAPIController');

    // Route::any('/{all?}', function () {
    //     return response()->json(['code' => 404, 'message' => 'NOT FOUND']);
    // })->where(['all' => '.*']);
});
