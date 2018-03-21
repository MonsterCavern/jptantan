<?php 
namespace App\Services;

use Stichoza\GoogleTranslate\TranslateClient;
use App\Json;
use App\Model\Translator;

/**
 *
 */
class GoogleTranslationService
{
    /**
     * 從 urlMap 取得 url 翻譯後 存到 translate 內
     */
    public function auto($urlID, $data)
    {
      
        // $tr = new TranslateClient('ja', 'zh-TW');
        $tr = new TranslateClient();
        $tr->setTarget('zh-TW');
        
        $data  = Json::Decode($data);
        $title = $tr->translate($data['title']);
        
        $contents = [];
        foreach ($data['content'] as $paragraph) {
            $contents[] = $tr->translate($paragraph);
        }
        
        $translate = [
          'url_id'  => $urlID,
          'user_id' => 1,
          'title'   => $title,
          'content' => Json::Encode($contents)
        ];
        
        Translator::insert($translate);
    }
}
