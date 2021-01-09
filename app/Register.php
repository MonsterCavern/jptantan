<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    //

    public $timestamps = false;

    public $fillable = [
        'name', 'password', 'email'
    ];
}
