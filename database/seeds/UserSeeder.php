<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fakers = [
          [
            'name'     => 'Google Translate',
            'email'    => 'google@local.com',
            'password' => 'google'
          ],
          [
            'name'     => 'Baidu Fanyi',
            'email'    => 'baidu@local.com',
            'password' => 'baidu'
          ]
        ];
        foreach ($fakers as $faker) {
            // $faker['session'] =  encrypt(Date('YmdHis').$faker['email']);
            $faker['password'] = Hash::make($faker['password']);
            User::insert($faker);
        }
    }
}
