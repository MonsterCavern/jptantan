<?php

use Illuminate\Database\Seeder;
use App\Models\UrlMap;

class TestUrlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //factory(App\Model\UrlMap::class, 5)->create();
        $urlData = [
          [
            'url'     => 'https://ncode.syosetu.com/n2267be/1/?a=b#tag',
            'title'   => 'Ｒｅ：ゼロから始める異世界生活 - プロローグ　『始まりの余熱』',
          ],
          [
            'url'   => 'https://ncode.syosetu.com/n2267be/2/',
            'title' => 'Ｒｅ：ゼロから始める異世界生活 - 第一章１　　『ギザ十は使えない』',
          ],
        ];
        
        // scheme && host 不能為空
        foreach ($urlData as $data) {
            $parseUrl         = parse_url($data['url']);
            $data['scheme']   = $parseUrl['scheme'];
            $data['host']     = $parseUrl['host'];
            $data['path']     = $parseUrl['path']??'';
            $data['query']    = $parseUrl['query']??'';
            $data['fragment'] = $parseUrl['fragment']??'';
            UrlMap::insert($data);
        }
    }
}
