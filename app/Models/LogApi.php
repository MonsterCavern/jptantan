<?php

namespace App\Models;

use Eloquent as Model;

/**
 * @OA\Schema(
 *      schema="LogApi",
 *      required={""},
 *      @OA\Property(
 *          property="code",
 *          description="code",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="remote_addr",
 *          description="remote_addr",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="params",
 *          description="params",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="method",
 *          description="method",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="uri",
 *          description="uri",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="own_id",
 *          description="own_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="own_type",
 *          description="own_type",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="response",
 *          description="response",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="response_time",
 *          description="response_time",
 *          type="number",
 *          format="float"
 *      ),
 *      @OA\Property(
 *          property="user_agent",
 *          description="user_agent",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="header",
 *          description="header",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="sql",
 *          description="sql",
 *          type="string"
 *      )
 * )
 */
class LogApi extends Model
{
    public $table      = 'logs_api';
    public $timestamps = false;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

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
        'header',
        'sql',
    ];

    public $include = [];

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
        'header'      => 'array',
        'sql'         => 'array',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    ];
}
