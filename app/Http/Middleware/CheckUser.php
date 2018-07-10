<?php

namespace App\Http\Middleware;

use Closure;
use App\Utils\Util;
use Illuminate\Support\Facades\Auth;
use GeoIP;

class CheckUser
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
        
        if (! is_array($token) || ! isset($token[1]) || count($token) !== 3) {
            return $next($request);
        }
        
        $guard      = $token[1];
        $expires_in = $token[2];
        
        $auth = Auth::guard($guard);
        $user = $auth->user();
        if ($auth) {
            $user->location = GeoIP::getLocation()->toArray();
            $request->attributes->add(['_user' => $user, '_expires_in' => $expires_in,  '_guard' => $guard]); // 'client'
        }
        
        return $next($request);
    }
}
