<?php
namespace App\Http\Controllers\Novel;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use Storage;
//use GuzzleHttp\Client;
use DiDom\Document;

class NovelController extends Controller {
    //

    public function restGet_new(Request $request) {
        // url 網址
        if ($request->has('url')) {
            $url = $request->url;
        } else {
            $url = 'http://ncode.syosetu.com/n9669bk';
        }

        $contents = Storage::disk('public')->get('novel.html');
        $document = new Document($contents);
        $title = $document->find('.novel_title');
        $date['title'] = ($title[0]->text());

        return response()->jsonb($date);

        // 取得 小說網址
        // 檢查 網址有無重複
        // 爬取網頁資料
        // 格式化 成 資料庫存儲方式
        // save
        // return 狀態訊息

        // files
    }
}
