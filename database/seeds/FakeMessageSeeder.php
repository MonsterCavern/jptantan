<?php

use Illuminate\Database\Seeder;
use App\Models\Message;

class FakeMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $message = Message::create([
            'nickname' => Str::random(10),
            'content' => Str::random(100),
            'email' => Str::random(100)
        ]);
    }
}
