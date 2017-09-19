<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;

class AuthsController extends Controller {
    public function restGet_login(Request $request) {
        var_dump($request);
    }
}
