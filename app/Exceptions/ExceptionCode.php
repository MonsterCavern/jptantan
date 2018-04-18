<?php
namespace App\Exceptions;

use Storage;
use App\Utils\Util;

/**
 *
 */
class ExceptionCode
{
    public static function getCodeFile($filename, $subfilename = 'json')
    {
        if ($subfilename) {
            $filename = $filename . '.' .$subfilename;
        }
        $file = Storage::disk('exception')->get($filename);
        return Util::JsonDecode($file);
    }
    
    public static function getCode()
    {
        $code =[];
        $files = Storage::disk('exception')->allFiles();
        foreach ($files as $file) {
            $code = array_merge($code, self::getCodeFile($file, false));
        }
        return $code;
    }
    
    public static function mapCodeMsg($msg)
    {
        $code = self::getCode();
        
        if (isset($code[$msg])) {
            return [
                'code'    => $code[$msg][0],
                'message' => $code[$msg][1]
            ];
        }
        
        return false;
    }
}
