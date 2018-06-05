<?php

namespace App\Http\Middleware;

use Closure;
use App\Utils\Util;
use Illuminate\Support\Facades\Auth;

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
        $expires_in = $request->get('_expires_in');
        if ($expires_in < time()) {
            // 過期
            return null;
        }
        
        $user = $request->get('_user');
        if (! $user) {
            return response()->json(['code' => '404','message' => 'NOT USER'], 404, ['Content-Type' => 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }
        if (! $this->checkPerm($user, $request)) {
            return response()->json(['code' => '403','message' => 'NOT PERM'], 403, ['Content-Type' => 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
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
        $check  = false;
        $uri    = $request->path();
        $method = $request->method();
        foreach ($user->roles as $role) {
            $perms = $role->permissions;
            foreach ($perms as $perm) {
                $http_path   = $perm->path;
                $http_method = $perm->method;
                
                $p = explode("\r\n", $http_path);
                foreach ($p as $value) {
                    if ('*' === $value && ($http_method === $method || $http_method === '')) {
                        $check = true;
                        break;
                    }
                    
                    if ($value === $uri && ($http_method === $method || $http_method === '')) {
                        $check = true;
                        break;
                    }
                }
            }
        }

        return $check;
    }
}
