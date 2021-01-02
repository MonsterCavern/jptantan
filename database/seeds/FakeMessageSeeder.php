<?php

use Illuminate\Database\Seeder;

class FakeMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('messages')->insert([
            'user_name' => Str::random(10),
            'content' => Str::random(10),
            'is_delete' => false
        ]);
    }
}
