<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\contracts\PostsRepoInterface;

class PostRepo implements PostsRepoInterface{
    public function createPost(array $data)
    {
        Post::create($data);
    }
}