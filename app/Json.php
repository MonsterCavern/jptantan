<?php
namespace App;

class Json {
    public static function Encode($str) {
        return json_encode($str, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    public static function Decode($str) {
        return json_decode($str, true);
    }
}
