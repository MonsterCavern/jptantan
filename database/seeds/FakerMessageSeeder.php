<?php

use Illuminate\Database\Seeder;
use App\Message;

class FakerMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Message::create([
            'name'=> '123',
            'email'=>'456',
            'content'=>'789',
        ]);
    }
}
