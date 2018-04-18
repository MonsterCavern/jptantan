<?php

namespace App\Utils;

/**
 *
 */
class Util
{
    /**
    * 將Json格式的字串 轉換為 PHP Array
    * @param string $inputstring 「JSON」格式字串
    * @return array PHP陣列
    */
    public static function JsonDecode($inputstring)
    {
        try {
            $input = str_replace("'", '"', $inputstring);
            $inputjson = json_decode($input, true);

            return $inputjson;
        } catch (\Exception $e) {
            return ResponseUtil::makeError($e);
        }
    }
    
    /**
    * 將Json格式的字串 轉換為 PHP Array
    * @param array $phparray 「JSON」格式字串
    * @return string Json string
    */
    public static function JsonEncode($phparray)
    {
        try {
            return json_encode($phparray, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        } catch (\Exception $e) {
            return ResponseUtil::makeError($e);
        }
    }
}
