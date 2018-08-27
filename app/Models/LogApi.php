<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class LogApi
 * @package App\Models
 * @version August 14, 2018, 6:36 am UTC
 *
 * @property string|\Carbon\Carbon timestamp
 * @property integer code
 * @property string remote_addr
 * @property string params
 * @property string method
 * @property string uri
 * @property string name
 * @property integer own_id
 * @property string own_type
 * @property string response
 * @property decimal response_time
 * @property string user_agent
 * @property string header
 */
class LogApi extends Model
{
    public $table = 'logs_api';
    
    public $timestamps = false;
    const CREATED_AT   = 'created_at';
    const UPDATED_AT   = 'updated_at';

    public $fillable = [
        'timestamp',
        'code',
        'remote_addr',
        'params',
        'method',
        'uri',
        'name',
        'own_id',
        'own_type',
        'response',
        'response_time',
        'user_agent',
        'header'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'code'        => 'integer',
        'remote_addr' => 'string',
        'params'      => 'array',
        'method'      => 'string',
        'uri'         => 'string',
        'name'        => 'string',
        'own_id'      => 'integer',
        'own_type'    => 'string',
        'response'    => 'array',
        'user_agent'  => 'string',
        'header'      => 'array'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    ];
}
