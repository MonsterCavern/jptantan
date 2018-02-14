<?php

use Illuminate\Database\Seeder;
use App\Http\Model\Translator;
use DB;

class TranslatorSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $usr = DB::table();
        // 必填 url, title, type
        $urls = [
            [
                'url'   => 'google.com',
                'title' => 'Google',
                'type'  => 'web'
            ],
            [
                'url'   => 'facebook.com',
                'title' => 'Facebook',
                'type'  => 'wbe'
            ]
        ];

        foreach ($urls as $url) {
            $translator = new Translator;
            foreach ($url as $key => $value) {
                $translator->$key = $value;
            }

            $translator->save();
        }
    }
}
