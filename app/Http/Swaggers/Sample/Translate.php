<?php

namespace App\Http\Swaggers\Sample;

use Eloquent as Model;

/**
 * @OA\Schema(
 *      schema="Translate",
 *      required={""},
 *      @OA\Property(
 *          property="target_id",
 *          description="target_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="target_type",
 *          description="target_type",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="user_id",
 *          description="user_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @OA\Property(
 *          property="content",
 *          description="content",
 *          type="array",
 *          @OA\Items(
 *            type="string",
 *            default="content"
 *          )
 *      ),
 *      @OA\Property(
 *          property="tags",
 *          description="tags",
 *          type="array",
 *          @OA\Items(
 *            type="string",
 *            default="tag"
 *          )
 *      )
 * )
 */
class Translate extends Model
{
    public $table = 'translates';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $fillable = [
        'target_id',
        'target_type',
        'user_id',
        'content',
        'tags'
    ];
    
    public $include = [
      'bokete'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'target_id'   => 'integer',
        'target_type' => 'string',
        'user_id'     => 'integer',
        'content'     => 'array',
        'tags'        => 'array'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    ];
}
