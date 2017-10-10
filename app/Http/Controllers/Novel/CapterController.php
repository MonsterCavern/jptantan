<?php

namespace App\Http\Controllers\Novel;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use DiDom\Document;

class CapterController extends Controller
{
    //
    public function restGet_saveNew($url='', $updated_at='')
    {
        $url = 'http://ncode.syosetu.com/n9669bk/1';
        $document = new Document($url, true);
        $novel_subtitle = $document->find('.novel_subtitle')[0]->text();
        $novel_honbuns = $document->find('#novel_honbun')[0]->children();

        var_dump($novel_subtitle);

        foreach ($novel_honbuns as $key => $value) {
            var_dump($value->html());
        }
        exit;
        $intro = [
          'jp' =>[
            'name' => $novel_subtitle,
            'intro'=> ''
          ],
          'tw' =>[
            'name' => '',
            'intro'=> ''
          ]
        ];

        $data = [
          'intro' => $intro,
          'content' => $content,
          'updated_at' => $updated_at
        ];

        //$status = DB::table('novels')->insert($data);
    }
}
