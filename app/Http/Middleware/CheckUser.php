<?php

namespace App\Http\Middleware;

use App;
use App\Utils\Util;
use Illuminate\Support\Facades\Auth;
use GeoIP;
use Closure;

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
        // lang
        $lang = $request->headers->get('Accept-Language');
        if ($lang) {
            $lang = explode(',', $lang)[0];
            App::setLocale($lang);
        }
        
        $token = Util::getTokenForRequest($request);
        $token = Util::decryptToken($token);
        
        if (! $token) {
            $guard          = 'guest';
            $user           = (object)['id' => 0];
            $user->location = GeoIP::getLocation()->toArray();
            $request->attributes->add(['_user' => $user, '_guard' => $guard]); // 'client'
            return $next($request);
        }
        
        // if (! is_array($token) || ! isset($token[1]) || count($token) !== 3) {
        //     return $next($request);
        // }
        
        $guard      = $token[1];
        $expires_in = $token[2];
        
        $auth = Auth::guard($guard);
      
        $user = $auth->user();
        if ($user) {
            $user->location = GeoIP::getLocation()->toArray();
            $request->attributes->add(['_user' => $user, '_expires_in' => $expires_in,  '_guard' => $guard]); // 'client'
        } else {
            // throw new \Exception(__('error.invalid', ['attribute' => __('common.token')]), 500200);
        }

        return $next($request);
    }
}
