<?php

use Illuminate\Database\Seeder;

class AdminMappingGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $default = [
            [
                'account'  => 'admin',
                'group_id' => 1,
                'perm'     => 0
            ],
            [
                'account'  => 'cosmos',
                'group_id' => 2,
            ]
        ];
        
        foreach ($default as $value) {
            $admin = DB::table('admins')->where('account', $value['account'])->first();
            if ($admin) {
                DB::table('admin_group_admins')->insert([
                    'group_id' => $value['group_id'],
                    'admin_id' => $admin->id,
                    'perm'     => $value['perm']??1
                ]);
            }
        }
    }
}
