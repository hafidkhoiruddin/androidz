<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contract\UserContract;

class UserRepository implements UserContract
{
    protected $model;

    /**
     * Constructor.
     * 
     */
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * Register new user.
     * 
     * @param Request $request
     * @return mix
     */
    public function signup($request)
    {
        $user = $this->model->where('email', $request->email)->first();
        
        if (!$user) {
            return $this->model->create([
                'role_id' => $request->role,
                'name' => $request->name,
                'email' => $request->email,
                'password' => app('hash')->make($request->password)
            ]);
        }

        return false;
    }

    /**
     * Authenticate user.
     * 
     * @param Request $request
     * @return mix
     */
    public function signin($request)
    {
        $user = $this->model->where('email', $request->email)->first();

        if ($user) {
            if (app('hash')->check($request->password, $user->password)) {

                $user->update(['access_token' => str_random(100)]);

                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'access_token' => $user->access_token
                ];
            } else {
                return false;
            }
        }

        return null;
    }

    /**
     * Logout an user.
     * 
     * @param string $token
     * @return bool
     */
    public function signout($token)
    {
        $user = $this->model->where('access_token', $token)->first();

        if ($user) {
            $user->update(['access_token' => null]);
            return true;
        }

        return false;
    }
}