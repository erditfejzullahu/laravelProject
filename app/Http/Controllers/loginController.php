<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\userLoginInterface;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class loginController extends Controller
{
   private $authService;

   public function __construct(userLoginInterface $authService){
    $this->authService = $authService;
    // $this->middleware('jwt.auth', ['only' => ['login']]);
   }

   public function login(Request $request){

    $credentials = $request->only('email', 'password');
    Log::debug('asdasd' . print_r($credentials, true));
    return $this->authService->loginUser($credentials);
   }

   public function register(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $dataToRegister = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        if ($dataToRegister) {

            $this->authService->registerUser($dataToRegister);

            return response()->json([
                'status' => true,
                'message' => "user Created",
            ], 201);
        }
    }

}
