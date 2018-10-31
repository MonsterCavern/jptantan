<?php

namespace App\Models;

use Eloquent as Model;

/**
 * @OA\Schema(
 *      schema="Bokete",
 *      required={""},
 *      @OA\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="number",
 *          description="number",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="url",
 *          description="url",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="content",
 *          description="content",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="ranting",
 *          description="ranting",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="image",
 *          description="image",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="source",
 *          description="source",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="is_updated",
 *          description="is_updated",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="google_translate_id",
 *          description="google_translate_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="baidu_translate_id",
 *          description="baidu_translate_id",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class Bokete extends Model
{
    public $table = 'boketes';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'number',
        'url',
        'content',
        'ranting',
        'image',
        'source',
        'is_updated',
        'released_at',
        'google_translate_id',
        'baidu_translate_id',
    ];

    public $include = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                  => 'integer',
        'number'              => 'integer',
        'url'                 => 'string',
        'content'             => 'array',
        'ranting'             => 'integer',
        'image'               => 'string',
        'source'              => 'string',
        'is_updated'          => 'integer',
        'google_translate_id' => 'integer',
        'baidu_translate_id'  => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    ];
}
