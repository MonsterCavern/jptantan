<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;

use App\Models\Admin;

class CheckRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = Auth::getTokenForRequest();
        if ($token) {
            try {
                $token = decrypt($token);
                $token = explode('@@', $token);
            } catch (DecryptException $e) {
                return null;
            }
        }
        
        if (!is_array($token) || !isset($token[1]) || count($token) !== 3) {
            return null;
        }
        
        $guard = $token[1];
        $expires_in = $token[2];
        
        if ($expires_in < time()) {
            // 過期
            return null;
        }
        
        $auth = Auth::guard($guard);
        $user = $auth->user();
        if (!$user) {
            return response()->json(['code'=>'404','message'=> 'NOT FOUND USER'], 404, ['Content-Type:application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }
        
        if (!$this->checkPerm($user, $request)) {
            return response()->json(['code'=>'403','message'=> 'NOT PERM'], 403, ['Content-Type:application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }
        return $next($request);
    }
    
    /**
     * [checkPerm description]
     * @param  Object  $user
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    public function checkPerm($user, $request)
    {
        $check = false;
        $uri = $request->path();
        $method = $request->method();
        foreach ($user->roles as $role) {
            $perms = $role->permissions;
            foreach ($perms as $perm) {
                $http_path   = $perm->http_path;
                $http_method = $perm->http_method;
                $prifix = $perm->prifix;
        
                $p = explode("\r\n", $http_path);
                foreach ($p as $value) {
                    if ('*' === $value && ($http_method === $method || $http_method ==='')) {
                        $check = true;
                        break;
                    }
                    
                    if ($prifix.$value === $uri && ($http_method === $method || $http_method ==='')) {
                        $check = true;
                        break;
                    }
                }
            }
        }
        return $check;
    }
}
