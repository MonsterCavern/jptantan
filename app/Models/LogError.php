<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class LogError
 * @package App\Models
 * @version August 19, 2018, 1:42 pm UTC
 *
 * @property string|\Carbon\Carbon timestamp
 * @property string exception
 * @property string message
 * @property string file
 * @property integer line
 * @property string trace
 */
class LogError extends Model
{
    public $table      = 'logs_err';
    public $timestamps = false;
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'timestamp',
        'exception',
        'message',
        'file',
        'line',
        'trace'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'exception' => 'string',
        'message'   => 'string',
        'file'      => 'string',
        'line'      => 'integer',
        'trace'     => 'array'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    ];
}
