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
        'publishing',
        'description',
        'status',
        'lasted_at'
    ];
}
