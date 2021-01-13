<?php

//s2twp.json 簡體到繁體（臺灣正體標準）並轉換為臺灣常用詞彙
if (! function_exists('opencc')) {
    function opencc($string, $config = 's2twp.json')
    {
        $od   = opencc_open($config);
        $text = opencc_convert($string, $od);
        opencc_close($od);

        return $text;
    }
}

if (! function_exists('openccs')) {
    function openccs($strings, $config = 's2twp.json')
    {
        $od   = opencc_open($config);
        foreach ($strings as $key => $string) {
            $strings[$key] = opencc_convert($string, $od);
        }
        opencc_close($od);

        return $strings;
    }
}

if (! function_exists('encodeJson')) {
    function encodeJson($str)
    {
        return json_encode($str, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}

if (! function_exists('decodeJson')) {
    function decodeJson($str)
    {
        return json_decode($str, true);
    }
}

if (! function_exists('getQueryLog')) {
    function getQueryLog()
    {
        $events =  \Illuminate\Support\Facades\DB::getQueryLog();
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

if (! function_exists('flushQueryLog')) {
    function flushQueryLog()
    {
        return \Illuminate\Support\Facades\DB::flushQueryLog();
    }
}
