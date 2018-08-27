<?php

namespace App\Utils;

use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use DB;

/**
 *
 */
class Util
{
    const INPUTKEY = 'token';
    
    /**
     * 將Json格式的字串 轉換為 PHP Array
     * @param string $inputstring 「JSON」格式字串
     * @return array PHP陣列
     */
    public static function JsonDecode($inputstring)
    {
        try {
            $input     = str_replace("'", '"', $inputstring);
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
    
    /**
     * Get the token for the current request.
     * @param  Request  $request
     * @param  String  $key
     * @return string
     */
    public static function getTokenForRequest(Request $request, $key = null)
    {
        $key   = $key ?? self::INPUTKEY;
        $token = $request->query($key);
        
        if (empty($token)) {
            $token = $request->bearerToken();
        }
        
        if (empty($token)) {
            $token = $request->input($key);
        }

        if (empty($token)) {
            $token = $request->getPassword();
        }
        
        return $token;
    }
    
    /**
     * Get the token for the current request.
     * @param  String  $token
     * @param  String  $type
     * @param Array $verification
     * @return string
     */
    public static function decryptToken($token, $type = 'string', $verification = [])
    {
        try {
            $token = decrypt($token);
        } catch (DecryptException $e) {
            return false;
            // return response()->json(['code' => '403', 'message' => 'TOKEN ERROR'], 404, ['Content-Type' => 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);
        }
        
        if ($type === 'string') {
            $token = explode('@@', $token);
        }
        
        return $token;
    }
    
    public static function getSqlLogs()
    {
        $events =  DB::getQueryLog();
        $logs   = [];
        foreach ($events as $event) {
            $time   = $event['time']; // ms
            $sql    = str_replace('?', "'%s'", $event['query']);
            $log    = vsprintf($sql, $event['bindings']);
            $logs[] = '['.date('Y-m-d H:i:s').']'.'['.(int)$time.'] '.$log ;
        }
        
        return $logs;
    }
}
