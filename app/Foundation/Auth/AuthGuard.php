<?php
namespace App\Foundation\Auth;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Auth\GuardHelpers;

use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;

class AuthGuard implements Guard
{
    use GuardHelpers;
    
    /**
     * The request instance.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;
    protected $provider;
    
    protected $user;
    protected $inputKey;
    protected $storageKey;
 
    /**
     * Create a new authentication guard.
     *
     * @param  \Illuminate\Contracts\Auth\UserProvider  $provider
     * @param  \Illuminate\Http\Request  $request
     * @param string $inputKey
     * @param string $storageKey
     * @return void
     */
    public function __construct(UserProvider $provider, Request $request, $inputKey = 'api_token', $storageKey = 'api_token')
    {
        $this->user     = null;
        $this->request  = $request;
        $this->provider = $provider;
        
        $this->inputKey   = $inputKey;
        $this->storageKey = $storageKey;
    }
    
    /**
     * Get the currently authenticated user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user()
    {
        // if ($this->loggedOut) {
        //     return;
        // }

        if (! is_null($this->user)) {
            return $this->user;
        }

        // 用 Token 判斷
        $user = null;

        $token = $this->getTokenForRequest();
        if (! empty($token)) {
            $user = $this->provider->retrieveByCredentials(
                [$this->storageKey => $token]
            );
        }

        return $this->user = $user;
    }
    
    /**
     * Get the token for the current request.
     *
     * @return string
     */
    public function getTokenForRequest()
    {
        $token = $this->request->query($this->inputKey);

        // TODO X-SESSION
        if (empty($token)) {
            $token = $this->request->headers->get('x-apitoken');
        }
        
        if (empty($token)) {
            $token = $this->request->input($this->inputKey);
        }

        if (empty($token)) {
            $token = $this->request->bearerToken();
        }

        if (empty($token)) {
            $token = $this->request->getPassword();
        }
        
        

        return $token;
    }
    
    
    
    /**
     * Attempt to authenticate a user using the given credentials.
     *
     * @param  array  $credentials
     * @param  bool   $remember
     * @return bool
     */
    public function attempt(array $credentials = [], $remember = false)
    {
        // 註冊事件
        // $this->fireAttemptEvent($credentials, $remember);
        
        // 使用 api_token
        // if (!empty($credentials[$this->inputKey])) {
        //     $credentials = [$this->storageKey => $credentials[$this->inputKey]];
        // }
        
        $this->lastAttempted = $user = $this->provider->retrieveByCredentials($credentials);

        if (! is_null($user) && $this->provider->validateCredentials($user, $credentials)) {
            $this->login($user, $remember);

            return true;
        }

        // 註冊事件
        // $this->fireFailedEvent($user, $credentials);

        return false;
    }
    

    
    public function validate(array $credentials = [])
    {
        if (empty($credentials[$this->inputKey])) {
            return false;
        }

        $credentials = [$this->storageKey => $credentials[$this->inputKey]];

        if ($this->provider->retrieveByCredentials($credentials)) {
            return true;
        }

        return false;
    }
    
    
    /**
     * Log a user into the application.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  bool  $remember
     * @return void
     */
    public function login($user, $remember = false)
    {

        // 註冊事件
        // $this->fireLoginEvent($user, $remember);

        $this->setUser($user);
    }
}
