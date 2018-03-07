<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UrlMap extends Model
{
    //
    protected $table = 'url_maps';
    
    public function dataTable()
    {
        dd($this->count());
    }
}
