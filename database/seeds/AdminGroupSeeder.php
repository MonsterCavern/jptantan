<?php

use Illuminate\Database\Seeder;

class AdminGroupSeeder extends Seeder
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
                'name' => 'Root群組'
            ],
            [
                'name' => '設計群組'
            ],
            [
                'name' => '執行群組'
            ],
            [
                'name' => '監督群組'
            ],
            [
                'name' => '一般群組'
            ],
            [
                'name' => '瀏覽群組'
            ]
        ];
        
        DB::table('admin_groups')->insert($groups);
    }
}
