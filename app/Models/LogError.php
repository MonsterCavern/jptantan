<?php

namespace App\Models;

use Eloquent as Model;

/**
 * @OA\Schema(
 *      schema="LogError",
 *      required={""},
 *      @OA\Property(
 *          property="exception",
 *          description="exception",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="message",
 *          description="message",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="file",
 *          description="file",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="line",
 *          description="line",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="trace",
 *          description="trace",
 *          type="string"
 *      )
 * )
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
        'trace',
    ];

    public $include = [];

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
        'trace'     => 'array',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    ];
}
