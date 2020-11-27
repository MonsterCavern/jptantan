<?php

use Illuminate\Database\Seeder;

class UserGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $groups = [
            [
                'name' => '管理群組'
            ],
            [
                'name' => 'RoBot群組'
            ],
            [
                'name' => '執行群組'
            ],
            [
                'name' => '監督群組'
            ]
        ];
        
        $default = [
            [
                'user_id'  => 1,
                'group_id' => 2,
                'perm'     => 0
            ],
            [
                'user_id'  => 2,
                'group_id' => 2,
                'perm'     => 0
            ]
        ];
        
        DB::table('user_groups')->insert($groups);
        DB::table('user_group_users')->insert($default);
    }
}
