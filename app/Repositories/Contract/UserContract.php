<?php

namespace App\Repositories\Contract;

interface UserContract
{
    /**
     * Register new user.
     * 
     * @param Request $request
     * @return mix
     */
    public function signup($request);

    /**
     * Authenticate user.
     * 
     * @param Request $request
     * @return mix
     */
    public function signin($request);
    
    /**
     * Logout an user.
     * 
     * @param string $token
     * @return bool
     */
    public function signout($token);
}