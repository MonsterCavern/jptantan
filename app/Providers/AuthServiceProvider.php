<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Foundation\Auth\AuthUserProvider;
use App\Foundation\Auth\AuthGuard;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        Auth::extend('admin', function ($app, $name, array $config) {
            // 回傳 Illuminate\Contracts\Auth\Guard 的實例...
            return new AuthGuard(Auth::createUserProvider($config['provider']), $app->make('request'), 'token', 'token');
        });
        
        Auth::extend('user', function ($app, $name, array $config) {
            // 回傳 Illuminate\Contracts\Auth\Guard 的實例...
            return new AuthGuard(Auth::createUserProvider($config['provider']), $app->make('request'), 'token', 'token');
        });

        Auth::provider('auth', function ($app, $config) {
            return new AuthUserProvider($this->app['hash'], $config['model'], $config['password'], 'token');
        });
    }
}
