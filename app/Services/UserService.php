<?php

namespace App\Services;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function createToken(User $user, $type, $token)
    {
        $token = $user->tokens()->create([
          'type'  => $type,
          'token' => $token
        ]);

        return $token;
    }

    public function createUserFromSocialLogin($attributes = [])
    {
        // 驗證必要參數
        $user = User::create([
          'name'     => $attributes['name'],
          'email'    => $attributes['email'],
          'status'   => $attributes['status'],
          'password' => Hash::make(Str::random(10))
        ]);

        return $user;
    }
}
