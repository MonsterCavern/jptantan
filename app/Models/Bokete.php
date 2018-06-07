<?php

namespace App\Models;

use Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Bokete",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="number",
 *          description="number",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="url",
 *          description="url",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="content",
 *          description="content",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="ranting",
 *          description="ranting",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="source",
 *          description="source",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="is_updated",
 *          description="is_updated",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="google_translate_id",
 *          description="google_translate_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
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
        'source',
        'is_updated',
        'released_at',
        'google_translate_id',
        'baidu_translate_id'
    ];

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
        'source'              => 'string',
        'is_updated'          => 'integer',
        'google_translate_id' => 'integer',
        'baidu_translate_id'  => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    ];
    
    /**
     * [translates description]
     * @return [type] [description]
     */
    public function translates()
    {
        return $this->hasMany('App\Models\Translate', 'target_id', 'number');
    }
}
