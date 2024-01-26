<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\userLoginInterface;

class loginController extends Controller
{
   private $authService;

   public function __construct(userLoginInterface $authService){
    $this->authService = $authService;
   }

   public function login(Request $request){

    $credintials = $request->only('email', 'password');

    return $this->authService->login($credintials);
   }

}
