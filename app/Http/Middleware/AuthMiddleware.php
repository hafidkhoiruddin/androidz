<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->header('Authorization');

        if (!$token) {
            return response()->json([
                'status_code' => 400,
                'message' => 'token tidak ditemukan.'
            ], 400);
        }

        $user = User::where('access_token', $token)->first();

        if (!$user) {
            return response()->json([
                'status_code' => 401,
                'message' => 'token tidak valid.'
            ], 401);
        }

        $request->auth = $user;
        $request->token = $token;
        
        return $next($request);
    }
}
