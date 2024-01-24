<?php

namespace App\Services;
use App\Models\allPosts;


class postService implements postServiceInterface{
    public function getPosts(){
        return allPosts::all();
    }

    public function postPost(array $data){
        return allPosts::create($data);
    }
}
