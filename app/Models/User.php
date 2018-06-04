<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Eloquent as Model;

/**
 * @SWG\Definition(
 *      definition="User",
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
 *          property="email",
 *          description="email",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="password",
 *          description="password",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="token",
 *          description="token",
 *          type="string"
 *      )
 * )
 */
class User extends Authenticatable
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

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'       => 'integer',
        'name'     => 'string',
        'email'    => 'string',
        'password' => 'string',
        'token'    => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    ];
    
    public function getAccount()
    {
        return 'email';
    }
    
    public function getDisplayName()
    {
        return $this->name;
    }
    
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'role_users', 'user_id', 'role_id');
    }
}
