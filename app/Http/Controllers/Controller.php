<?php
namespace App\Http\Controllers;

use DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

use App\Admins as admins;

class Controller extends BaseController {
    public function restGet(Request $request, $pid) {
        $uri = $request->path();
        $segments = explode('/', $uri);
        $tbl = $segments[1];
        if (Schema::hasTable($tbl)) {
            $httpStatusCode = 200;
            $data = DB::table($tbl)->where('id', '=', $pid)->get();
            if ($data->isEmpty()) {
                $httpStatusCode = 404;
            }
            return response()->json($data, $httpStatusCode);
        }

        return response();
    }

    public function restBulkGet(Request $request) {
        $uri = $request->path();
        $segments = explode('/', $uri);
        $tbl = $segments[2];
        if (Schema::hasTable($tbl)) {
            $httpStatusCode = 200;
            $data = DB::table($tbl)->get();
            if ($data->isEmpty()) {
                $httpStatusCode = 404;
            }
            return response()->json($data, $httpStatusCode);
        }
        return response()->json();
    }
}
