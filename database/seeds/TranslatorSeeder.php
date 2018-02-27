<?php

use Illuminate\Database\Seeder;
use App\Http\Model\Translator;

class TranslatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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

        $faker = Faker\Factory::create();
        //$urls = [];
        for ($i=0; $i < 50; $i++) {
            $urls[] = [
              'url'   => $faker->url,
              'title' => $faker->title,
              'type'  => 'web'
          ];
        }

        foreach ($urls as $url) {
            $translator = new Translator;
            foreach ($url as $key => $value) {
                $translator->$key = $value;
            }

            $translator->save();
        }
    }
}
