<?php

namespace App\Services;

interface postServiceInterface{
    public function getPosts();

    public function postPost(array $data);
}
