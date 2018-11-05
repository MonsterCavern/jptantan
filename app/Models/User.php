<?php

namespace App\Models;

use Eloquent as Model;

/**
 * @OA\Schema(
 *      schema="User",
 *      required={""},
 *      @OA\Property(
*          property="id",
*          description="id",
*          type="integer",
 *          format="int32"
*      ),
*      @OA\Property(
*          property="name",
*          description="name",
*          type="string"
*      ),
*      @OA\Property(
*          property="email",
*          description="email",
*          type="string"
*      ),
*      @OA\Property(
*          property="password",
*          description="password",
*          type="string"
*      ),
*      @OA\Property(
*          property="token",
*          description="token",
*          type="string"
*      )
 * )
 */

class User extends Model
{

    public $table = 'users';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';



    public $fillable = [
        'name',
        'email',
        'password',
        'token'
    ];
    
    public $include = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'password' => 'string',
        'token' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
