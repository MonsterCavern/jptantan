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
            return null;
        }
        $id = $user[$user->primaryKey];
        
        // Admin role

        // Vendor role


        return $next($request);
    }
}
