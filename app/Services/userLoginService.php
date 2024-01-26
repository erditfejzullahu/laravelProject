<?php

namespace App\Services;

use App\Services\userLoginInterface;
use Tymon\JWTAuth\Facades\JWTAuth;

class userLoginService implements userLoginInterface{
    public function login(array $credintials){
        if(!$token = JWTAuth::attempt($credintials)){
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token){

        $user = auth()->user();

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60,
            'user' => $user,
        ]);
    }
}
