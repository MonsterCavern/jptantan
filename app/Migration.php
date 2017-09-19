<?php
namespace App;

use DB;
use Illuminate\Database\Migrations\Migration;

class Migration extends Migration {
    public function comments($table) {
        foreach ($this->columns as $index => $value) {
            if (isset($value['comment']) && isset($value['name'])) {
                $sql = "comment on column ".$table.".".$value['name']." is '".$value['comment']."'";
                DB::statement($sql);
            }
        }
    }
}
