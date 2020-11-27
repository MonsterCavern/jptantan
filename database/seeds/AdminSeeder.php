<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [
          [
            'account'  => 'admin',
            'password' => 'admin',
            'type'     => 0,
          ],
          [
            'account'  => 'cosmos',
            'password' => 'cosmos',
          ]
        ];
        
        foreach ($admins as $admin) {
            $admin['password'] = Hash::make($admin['password']);
            DB::table('admins')->insert($admin);
        }
    }
}
