<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;

use App\Utils\Util;

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
        $token = Util::getTokenForRequest($request);
        $token = Util::decryptToken($token);
        
        if (!is_array($token) || !isset($token[1]) || count($token) !== 3) {
            return response()->json(['code'=>'403','message'=> 'TOKEN NOT FOUND'], 404, ['Content-Type'=>'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
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
            return response()->json(['code' => '404','message'=> 'NOT FOUND USER'], 404, ['Content-Type'=>'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }
        
        if (!$this->checkPerm($user, $request)) {
            return response()->json(['code'=>'403','message'=> 'NOT PERM'], 403, ['Content-Type' => 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }
        
        $request->attributes->add(['_user' => $user, '_guard' => $guard]); // 'client'
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
                $http_path   = $perm->path;
                $http_method = $perm->method;
                $prefix = $perm->prefix;
                
                $p = explode("\r\n", $http_path);
                foreach ($p as $value) {
                    if ('*' === $value && ($http_method === $method || $http_method ==='')) {
                        $check = true;
                        break;
                    }
                    
                    if ($prefix.$value === $uri && ($http_method === $method || $http_method ==='')) {
                        $check = true;
                        break;
                    }
                }
            }
        }
        return $check;
    }
}
