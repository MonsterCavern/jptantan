<?php

/**
 *
 */

namespace App\Foundation\Auth;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Str;

class AuthUserProvider extends EloquentUserProvider
{
    public function __construct(HasherContract $hasher, $model, $pwField = 'password', $apiField = 'api_token')
    {
        parent::__construct($hasher, $model);
        $this->passwordField = $pwField;
        $this->apiField      = $apiField;
    }
  
    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        // dd($credentials, $this->passwordField, $this->apiField);
        if (empty($credentials) || false === (
                array_key_exists($this->passwordField, $credentials) ||
                array_key_exists($this->apiField, $credentials)
              )
         ) {
            return null;
        }
        
        // First we will add each credential element to the query as a where clause.
        // Then we can execute the query and, if we found a user, return it in a
        // Eloquent User "model" that will be utilized by the Guard instances.
        $model = $this->createModel();
        $query = $model->newQuery();
        
        if (isset($credentials['account'])) {
            if (method_exists($model, 'getAccount')) {
                $key               = $model->getAccount();
                $credentials[$key] = $credentials['account'];
                unset($credentials['account']);
            }
        }
        
        foreach ($credentials as $key => $value) {
            // 排除包含 密碼字元 的欄位
            if (! Str::contains($key, $this->passwordField)) {
                $query->where($key, $value);
            }
        }

        return $query->first();
    }
    
    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  array  $credentials
     * @return bool
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        $plain = $credentials[$this->passwordField];

        return $this->hasher->check($plain, $user->getAuthPassword());
    }
}
