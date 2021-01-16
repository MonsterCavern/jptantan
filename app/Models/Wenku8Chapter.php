<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wenku8Chapter extends Model
{
    //
    public $fillable = [
        'id',
        'wenku8_id',
        'url',
        'episode',
        'sequence',
        'title',
        'content',
    ];
}
