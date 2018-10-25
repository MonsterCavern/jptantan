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
        $exclude = [];
        $swagger = \OpenApi\scan([app_path('Http/Controllers'), app_path('Models')], ['exclude' => $exclude]);

        return response()->json($swagger);
    }
}
