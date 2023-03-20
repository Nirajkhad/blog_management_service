<?php 
namespace App\Repositories\contracts;

interface PostsRepoInterface{
    public function createPost(array $data);
    public function checkPost(array $condition):bool;
    public function getPosts():object;
    public function filterPosts(array $condition):object;
    public function updatePost(array $data,$condition);
    public function deletePost(array $condition);
}