<?php
namespace App\Http\Controllers\Novel;

use DB;
use App\Exceptions\Exception as Exception;
use Storage;
use App\Http\Controllers\Controller as Controller;
use App\Json;
use Illuminate\Http\Request;
use DiDom\Document;

class NovelController extends Controller {
    //
    public $syosetu_domain = 'http://ncode.syosetu.com';

    public function restGet_new(Request $request) {
        // url 網址
        if ($request->has('url')) {
            $url = $request->url;
        } else {
            $url = 'http://ncode.syosetu.com/n9669bk';
        }
        
        if ($request->has('lang')) {
            $lang = $request->lang;
        } else {
            $lang = 'jp';
        }
        
        $novel = new \App\Novel;
        if ($novel::where('url', '=', $url)->count() == 0) {
            $contents = Storage::disk('public')->get('novel.html');
            $document = new Document($contents);

            $title  = $document->find('.novel_title')[0]->text();
            $intros = $document->find('#novel_ex')[0]->text();
            $intros = preg_split('/\n|\r\n?/', $intros, -1, PREG_SPLIT_NO_EMPTY);
            $intro = [];
            foreach ($intros as $value) {
                $sentences = explode('。', $value);
                $intro[] = $sentences;
            }
            $novel->lang = $lang;
            $novel->url = $url;
            $novel->source_type = 'copy';
            $novel->setIntro($title, $intro);
            
            $capters = $document->find('.index_box')[0]->children();
            $temps = [];
            $temp = [];
            foreach ($capters as $key => $value) {
                if ($value->has('.chapter_title')) {
                    if (count($temp) > 0) {
                        $temps[] = $temp;
                        $temp = [];
                    }
                    $temp['title'] = $value->text();
                }
                if ($value->has('.subtitle')) {
                    $title = $value->find('a')[0]->text();
                    $href = $value->find('a')[0]->href;
                    $sub['title'] = $title;
                    $sub['url'] = $this->syosetu_domain.$href;
                    $sub['been_copy'] = 0;
                    //
                    $temp['subs'][] = $sub;
                }
            }
            $novel->setCapters($temps);
            $status = $novel->save();
        } else {
            $status = false;
        }
        return response()->jsonb($status);

        // 取得 小說網址
        // 檢查 網址有無重複
        // 爬取網頁資料
        // 格式化 成 資料庫存儲方式
        // save
        // return 狀態訊息

        // files
    }
}
