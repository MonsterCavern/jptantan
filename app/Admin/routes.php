<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

// Admin::registerAuthRoutes();

Route::group([
    'prefix'     => config('admin.route.prefix'),
    'namespace'  => 'App\Admin\Core',
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {
    $router->group([], function ($router) {
        $router->resource('auth/users', 'UserController');
        $router->resource('auth/roles', 'RoleController');
        $router->resource('auth/permissions', 'PermissionController');
        $router->resource('auth/menu', 'MenuController', ['except' => ['create']]);
        $router->resource('auth/logs', 'LogController', ['only' => ['index', 'destroy']]);
    });

    $router->get('auth/login', 'AuthController@getLogin');
    $router->post('auth/login', 'AuthController@postLogin');
    $router->get('auth/logout', 'AuthController@getLogout');
    $router->get('auth/setting', 'AuthController@getSetting');
    $router->put('auth/setting', 'AuthController@putSetting');
});

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {
    $router->group([
      'namespace'  => 'Translators',
    ], function ($router) {
        $router->resource('translators', 'TranslateController');
    });


    $router->get('/', 'HomeController@index');
});
