<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\contracts\PostsRepoInterface;

class PostsRepo implements PostsRepoInterface
{
    public function createPost(array $data)
    {
        Post::create($data);
    }

    public function checkPost(array $condition):bool
    {
        return Post::where($condition)->exists();
    }

    public function filterPosts(array $condition):object
    {
        return Post::where($condition)->paginate(20);
    }
    
    public function getPosts(): object
    {
        return Post::paginate(20);
    }

    public function updatePost(array $data,$condition)
    {
        Post::where($condition)->update($data);
    }

    public function deletePost(array $condition)
    {
        Post::where($condition)->delete();
    }
}
