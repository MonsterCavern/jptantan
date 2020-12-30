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
        'url_catalog',
        'publishing',
        'summary',
        'word_length',
        'status',
        'lasted_at'
    ];
}
