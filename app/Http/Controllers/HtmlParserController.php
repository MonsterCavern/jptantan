<?php

namespace App\Http\Controllers;

use DiDom\Document;

class HtmlParserController extends Controller
{
    //
    public function curl($url)
    {
        return response()->json([
          'code' => 200,
          'data' => $url
        ]);
    }
    
    public function parserSyosetu($url)
    {
        $data = [];
        try {
            $parseUrl = parse_url($url);
            if ($parseUrl['host'] == 'ncode.syosetu.com') {
                $document = new Document($url, true);
            } else {
                throw new \Exception("Domain is not ncode.syosetu.com", 1);
            }
          
            $novel_subtitle = $document->find('.novel_subtitle')[0]->text();
            $novel_honbun = $document->find('#novel_honbun')[0]->text();
            $result = preg_split('/[;\r\n]+/s', $novel_honbun);
            $data = [
              'title'   => $novel_subtitle,
              'content' => $result
            ];
        } catch (\Exception $e) {
            //
        }
        

        
        return $data;
    }
    
    public function parserTwitter($document)
    {
        # code...
    }
}
