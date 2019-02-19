<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contract\UserContract;

class AuthController extends Controller
{
    private $userRepo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserContract $user)
    {
        $this->userRepo = $user;

        $this->middleware('auth', ['only' => ['signout']]);
    }

    /**
     * Signup new user.
     * 
     * @param Request $request
     * @return json
     */
    public function signup(Request $request)
    {
        $res = $this->userRepo->signup($request);
        
        if ($res === false) {
            return response()->json([
                'status_code' => 400,
                'message' => 'email telah digunakan.'
            ], 400);
        }

        return response()->json([
            'status_code' => 201,
            'user' => $res
        ], 201);
    }

    /**
     * Signin a user.
     * 
     * @param Request $request
     * @return json
     */
    public function signin(Request $request)
    {
        $res = $this->userRepo->signin($request);

        if ($res === null) {
            return response()->json([
                'status_code' => 404,
                'message' => 'akun belum terdaftar.'
            ], 404);
        }

        if ($res === false) {
            return response()->json([
                'status_code' => 401,
                'message' => 'email atau password salah.'
            ], 401);
        }

        return response()->json([
            'status_code' => 200,
            'message' => 'berhasil',
            'user' => $res
        ], 200);
    }

    /**
     * Signout an user.
     * 
     * @param Request $request
     * @return json
     */
    public function signout(Request $request)
    {
        $res = $this->userRepo->signout($request->token);

        if ($res) {
            return response()->json([
                'status_code' => 200,
                'message' => 'berhasil signout.'
            ], 200);
        }

        return response()->json([
            'status_code' => 400,
            'message' => 'gagal signout.'
        ], 400);
    }
}
