<?php
namespace App\Http\Controllers\Novel;

use App\Http\Controllers\Controller as Controller;
use App\Json;
use Illuminate\Http\Request;
use DiDom\Document;
use DB;

class CapterController extends Controller {
    //
    public function restGet_saveNew($url='', $updated_at='') {
        $updated_at = date('Y-m-d H:i:s');
        $url = 'http://ncode.syosetu.com/n9669bk/1';
        $document = new Document($url, true);
        $novel_subtitle = $document->find('.novel_subtitle')[0]->text();
        $novel_honbuns = $document->find('#novel_honbun')[0]->children();

        $content['title'] = $novel_subtitle;

        foreach ($novel_honbuns as $key => $value) {
            if ($value->html()) {
                $content['content'][] = $value->html();
            }
        }
        $contents[] = $content;
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
          'intro' => Json::Encode($intro),
          'content' => Json::Encode($contents),
          'updated_at' => $updated_at
        ];
        $status = DB::table('novel_capters')->insert($data);
    }
}
