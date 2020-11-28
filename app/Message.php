<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //

    public $timestamps = false;

    public $fillable = [
        'name', 'email','content'
    ];
}
