<?php

namespace App\Libraries\Translate;

use Stichoza\GoogleTranslate\TranslateClient;
use App\Json;
use App\Model\Translator;

/**
 *
 */
class GoogleTranslation
{
    public function execute($data, $lang = 'zh-TW')
    {
        $tr = new TranslateClient();
        $tr->setTarget($lang);
        try {
            if (is_array($data)) {
                foreach ($data as &$value) {
                    $value = $tr->translate($value);
                }
            } else {
                $data = $tr->translate($data);
            }
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            // exit;
        }
        
        return $data;
    }
}
