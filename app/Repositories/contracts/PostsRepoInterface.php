<?php 
namespace App\Repositories\contracts;

interface PostsRepoInterface{
    public function createPost(array $data);
}