<?php

namespace App\Models;

use Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="Permission",
 *      required={""},
 *      @SWG\Property(
 *          property="id",
 *          description="id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="slug",
 *          description="slug",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="prifix",
 *          description="prifix",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="http_method",
 *          description="http_method",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="http_path",
 *          description="http_path",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="read_only",
 *          description="read_only",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class Permission extends Model
{

    public $table = 'permissions';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'name',
        'slug',
        'prifix',
        'http_method',
        'http_path',
        'read_only'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'slug' => 'string',
        'prifix' => 'string',
        'http_method' => 'string',
        'http_path' => 'string',
        'read_only' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
