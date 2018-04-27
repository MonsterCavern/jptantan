<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends AppBaseController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
          'type'     => 'string',
          'account'  => 'required|string',
          'password' => 'required',
          
        ]);
      
        if ($validator->fails()) {
            return response()->json(['code'=>'403','message'=>$validator], 200, ['Content-Type' => 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }
        
        $guard = 'admin';
        $credentials = [
            'account' => $request->account,
            'password'  => $request->password,
        ];
        
        if ($request->has('type') && $request->type === 'admin') {
            $guard = $request->type;
        }
        $auth = Auth::guard($guard);
        if ($auth->attempt($credentials)) {
            $user = $auth->user();
            $user->token = $this->restToken($guard, 30);
            $user->save();
            $data = [
              // 'account'   => $user->account,
              'token' => $user->token
            ];
            return response()->json(['code'=>'200','data'=> $data], 200, ['Content-Type' => 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json(['code'=>'404','message'=>'NOT FOUND'], 200, ['Content-Type' => 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }
    }
    
    public function restToken($guard, $day = 30, $str_n = 10)
    {
        $time = time();
        // $expires_in =  date("Y-m-d", strtotime(date("Y-m-d", $time)." + $day day"));
        $token = [
          'random'      => str_random($str_n),
          'guard'      => $guard,
          'time'       => $time + (3600*24*$day)
        ];
        $token = implode('@@', $token);
        $token = encrypt($token);
        // dd($token, strlen($token), decrypt($token));
        return $token;
    }
}
