<?php
namespace App\Http\Controllers\Novel;

use DB;
use Exception;
use Storage;
use App\Http\Controllers\Controller as Controller;
use App\Json;
use Illuminate\Http\Request;
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

        $data['url']         = $url;
        $data['source_type'] = 'copy';

        $params['title']  = $document->find('.novel_title')[0]->text();
        $params['intros'] = $document->find('#novel_ex')[0]->text();

        // 查找 $authors, 假如沒有則新建一筆回傳id
        // 或是先空著, 之後在對應
        if (isset($author_id)) {
            $data['author_id'] = $author_id;
        }


        $lang = 'jp';//$request->lang;
        $status = $this->saveNew($data, $params, $lang);

        return response()->jsonb($status);

        // 取得 小說網址
        // 檢查 網址有無重複
        // 爬取網頁資料
        // 格式化 成 資料庫存儲方式
        // save
        // return 狀態訊息

        // files
    }


    /**
     * 新建 小說目錄
     * 假如建立成功 回傳 章節 url 陣列
     *
     * @param $data(直接儲存的資料), $params(需要處理的資料), $lang(語系)
     * @return $status[true,fale], novel_capters_urls
     */
    public function saveNew($data, $params, $lang) {
        $intros = preg_split('/\n|\r\n?/', $params['intros'], -1, PREG_SPLIT_NO_EMPTY);
        $intro = [];
        foreach ($intros as $value) {
            $sentences = explode('。', $value);
            $intro[] = $sentences;
        }

        // jsonb
        $intros = [];
        $intros[$lang] = [
            'title' => $params['title'],
            'intro' => $intro
        ];
        $data['intro'] = Json::Encode($intros);
        try {
            $status = DB::table('novels')->insert($data);
        } catch (Exception $e) {
            $code           = $e->getCode();
            $res['status'] = false;
            $res['code']   = $code;
            return response()->json($res, 404);
        }
        return $status;
    }
}
