<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;

class SocialController extends Controller
{
    /**
     * 將用戶重定向到GitHub身份驗證頁面。
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * 從GitHub獲取用戶信息。
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();
    }
}
