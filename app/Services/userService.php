<?php

namespace App\Services;
use App\Models\allUsers;

class userService implements userServiceInterface{
    public function getAllUsers(){
        return allUsers::all();
        // return $users;
    }
}
