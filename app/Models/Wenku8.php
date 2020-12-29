<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wenku8 extends Model
{
    //
    public $fillable = [
        'id',
        'title',
        'author',
        'url',
        'url_img',
        'publishing',
        'summary',
        'status',
        'lasted_at'
    ];
}
