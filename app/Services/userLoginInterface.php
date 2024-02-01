<?php

namespace App\Services;

interface userLoginInterface{
    public function loginUser(array $credentials);
    public function registerUser(array $data);
}
