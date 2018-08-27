<?php

namespace App\Http\Swaggers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 *
 * @return mixed
 */
class SwaggerController extends Controller
{
    const HAS_PREFIX = false;

    public function doc($func = false, Request $res)
    {
        // 排除自己以外的 檔案夾
        $exclude          = [];
        // $DirNameSapcePath = app_path('Http/Controllers/'.ucfirst($res->func));
        // if ($func && is_dir($DirNameSapcePath)) {
        //     $dirs = glob(app_path('Http/Controllers/*'), GLOB_ONLYDIR);
        //     foreach ($dirs as $dir) {
        //         if ($DirNameSapcePath !== $dir) {
        //             $exclude[] = $dir;
        //         }
        //     }
        // }
        $swagger = \OpenApi\scan([app_path('Http/Controllers'), app_path('Models')], ['exclude' => $exclude]);
        // dd($swagger, $swagger->toJson());
        // $swagger = Util::JsonDecode($swagger);

        // $this->jsonPath = '/vendor/swagger/json';
        // foreach ($swagger['tags'] as $tags) {
        //     $paths = $this->createPath($tags['name'], $swagger['paths']);
        //
        //     $swagger['paths'] = $paths;
        // }

        // return $swagger->toJson();
        return response()->json($swagger);
    }

    // public function view($func = false, Request $res)
    // {
    //     $url  = ($func) ? '/'.$func : '';
    //     $url  = asset('/doc').$url;
    //     $data = [
    //       'title'     => 'SWAGGER',
    //       'url'       => $url,
    //       'urlToDocs' => '/doc'
    //     ];
    //
    //     return view('vendor.swagger-ui.index', $data);
    // }
    //
    // public static function merge(array $arr1, array $arr2)
    // {
    //     if (empty($arr1)) {
    //         return $arr2;
    //     } elseif (empty($arr2)) {
    //         return $arr1;
    //     }
    //     foreach ($arr2 as $key => $value) {
    //         if (is_int($key) && array_key_exists('0', array_slice($arr2, 0, 1, true))) {
    //             $arr1[] = $value;
    //         } elseif (is_array($arr2[$key])) {
    //             if (! isset($arr1[$key])) {
    //                 $arr1[$key] = [];
    //             }
    //             if (is_int($key) && array_key_exists('0', array_slice($arr2, 0, 1, true))) {
    //                 $arr1[] = static::merge($arr1[$key], $value);
    //             } else {
    //                 $arr1[$key] = static::merge($arr1[$key], $value);
    //             }
    //         } else {
    //             $arr1[$key] = $value;
    //         }
    //     }
    //
    //     return $arr1;
    // }
    //
    // // 只能取代陣列第一層
    // public function createPath($path = 'pathName', $paths = [])
    // {
    //     $arr = $paths;
    //
    //     //
    //     $name_no_key = '/'.$path.'s';
    //     if (! isset($arr[$name_no_key])) {
    //         $arr[$name_no_key] = [];
    //     }
    //
    //     $arr[$name_no_key] = static::merge($this->createBulkGet($path), $arr[$name_no_key]);
    //     //
    //     $pramaryKey   = (self::HAS_PREFIX) ? strtolower($path).'_id' : 'id' ;
    //     $name_has_key = '/'.$path.'s/{'.$pramaryKey.'}' ;
    //     if (! isset($arr[$name_has_key])) {
    //         $arr[$name_has_key] = [];
    //     }
    //     $arr[$name_has_key] =  static::merge($this->createGet($path, $pramaryKey), $arr[$name_has_key]);
    //     $arr[$name_has_key] =  static::merge($this->createPost($path, $pramaryKey), $arr[$name_has_key]);
    //     $arr[$name_has_key] =  static::merge($this->createDelete($path, $pramaryKey), $arr[$name_has_key]);
    //
    //     return $arr;
    // }
    //
    // public function createBulkGet($path)
    // {
    //     $arr        = [];
    //     $arr['get'] = [
    //       'tags'        => [$path],
    //       'description' => '取得 '.$path.' 列表',
    //       'produces'    => ['application/json'],
    //       'parameters'  => [
    //         ['$ref' => $this->jsonPath.'/request.json#skipParam'],
    //         ['$ref' => $this->jsonPath.'/request.json#limitParam'],
    //         ['$ref' => $this->jsonPath.'/request.json#sortParam']
    //       ],
    //       'responses'   => [
    //         '200' => [
    //           'description' => '依照 篩選條件 返回列表',
    //           'schema'      => [
    //               'type'  => 'array',
    //               'items' => ['$ref' => '#/definitions/'.$path]
    //           ]
    //         ],
    //         '404' => [
    //           'description' => 'an unexpected error'
    //         ]
    //       ],
    //       'security' => [
    //         [
    //           'Session' => []
    //         ]
    //       ]
    //     ];
    //
    //     return $arr;
    // }
    //
    // public function createGet($path, $pramaryKey)
    // {
    //     $arr        = [];
    //     $arr['get'] = [
    //       'tags'        => [$path],
    //       'description' => '取得 '.$path.' 列表',
    //       'produces'    => ['application/json'],
    //       'parameters'  => [
    //         [
    //           'name'        => $pramaryKey,
    //           'in'          => 'path',
    //           'description' => '取得 '.$path.' 詳細資訊',
    //           'required'    => true,
    //           'type'        => 'integer',
    //           'format'      => 'int64'
    //         ]
    //       ],
    //       'responses'   => [
    //         '200' => [
    //           'description' => '依照 篩選條件 返回列表',
    //           'schema'      => [
    //               '$ref' => '#/definitions/'.$path
    //           ]
    //         ],
    //         '404' => [
    //           'description' => 'an unexpected error'
    //         ]
    //       ],
    //       'security' => [
    //         [
    //           'Session' => []
    //         ]
    //       ]
    //     ];
    //
    //     return $arr;
    // }
    //
    // public function createPost($path)
    // {
    //     $arr         = [];
    //     $arr['post'] = [
    //       'tags'        => [$path],
    //       'summary'     => '新增一個 '.$path.' row 資料',
    //       'description' => '新增一個 '.$path.' row 資料',
    //       'produces'    => ['application/json'],
    //       'parameters'  => [
    //         [
    //           'name'        => 'body',
    //           'in'          => 'body',
    //           'description' => '需要新增的 資料內容',
    //           'required'    => true,
    //           'schema'      => [
    //             '$ref' => '#/definitions/'.$path
    //           ]
    //         ]
    //       ],
    //       'responses'   => [
    //         '200' => [
    //           'description' => 'success',
    //         ],
    //         '404' => [
    //           'description' => 'Invalid input'
    //         ]
    //       ],
    //       'security' => [
    //         [
    //           'Session' => []
    //         ]
    //       ]
    //     ];
    //
    //     return $arr;
    // }
    //
    // public function createDelete($path, $pramaryKey)
    // {
    //     $arr           = [];
    //     $arr['delete'] = [
    //       'tags'        => [$path],
    //       'description' => '刪除指定的 '.$path.' row 資料',
    //       'produces'    => ['application/json'],
    //       'parameters'  => [
    //         [
    //           'name'        => $pramaryKey,
    //           'in'          => 'path',
    //           'description' => '取得 '.$path.' 詳細資訊',
    //           'required'    => true,
    //           'type'        => 'integer',
    //           'format'      => 'int64'
    //         ]
    //       ],
    //       'responses'   => [
    //         '200' => [
    //           'description' => 'Row 已刪除'
    //         ],
    //         '404' => [
    //           'description' => 'unexpected error'
    //         ]
    //       ],
    //       'security' => [
    //         [
    //           'Session' => []
    //         ]
    //       ]
    //     ];
    //
    //     return $arr;
    // }
}
