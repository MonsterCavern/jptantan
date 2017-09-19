<?php
namespace App\Providers;

use Illuminate\Support\Facades\Route;

class DynamicRoute extends Route {
    public function __construct() {
        var_dump($this);
        exit;
    }
    protected function dynamic($class = null) {
        return 'Controller@method';
    }
}
