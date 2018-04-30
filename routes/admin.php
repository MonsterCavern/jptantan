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


// admin API
Route::group([
  'prefix'     => 'api/admin',
  'namespace'  => "Admin",
  'middleware' => ['check.roles'],
], function () {
    Route::resource('admins', 'AdminAPIController');
    Route::resource('admin_groups', 'AdminGroupAPIController');
    Route::resource('users', 'UserAPIController');
    Route::resource('roles', 'RoleAPIController');
    Route::resource('permissions', 'PermissionAPIController');

    Route::any('/{all?}', function () {
        return response()->json(['code' => 404, 'message' => 'NOT FOUND']);
    })->where(['all' => '.*']);
});

// admin Web
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
