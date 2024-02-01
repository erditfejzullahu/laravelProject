<?php

namespace App\Services;

use App\Services\userLoginInterface;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;
use App\Models\User;


class userLoginService implements userLoginInterface{
    public function loginUser(array $credentials){
        if(!$token = JWTAuth::attempt($credentials)){
            Log::debug(print_r($credentials, true));
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token){

        $user = auth()->user();
        Log::debug($user);
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60,
            'user' => $user,
        ]);
    }

    public function registerUser(array $data) {
        return User::create($data);
    }
}
