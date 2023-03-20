<?php

namespace App\Http\Controllers\Api;

use App\Helper\Helpers;
use App\Http\Controllers\Controller;
use App\Repositories\contracts\PostsRepoInterface;
use App\Traits\ServiceResponser;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Throwable;

class PostController extends Controller
{

    use ServiceResponser;

    protected $postsRepository;
    protected $request;
    protected $helpers;

    public function __construct(PostsRepoInterface $postsRepository, Request $request, Helpers $helpers)
    {
        $this->postsRepository = $postsRepository;
        $this->request = $request;
        $this->helpers = $helpers;
    }

    public function addPost(): object
    {
        $this->validate($this->request, [
            "title" => "required|string|max:50",
            "content" => "required|string|max:255",
            "slug" => "required|string|max:30",
        ]);
        try {
            $postAlreadyExists = $this->postsRepository->checkPost(["title" => $this->request->title]);
            if ($postAlreadyExists) {
                return $this->errorResponse("Post already Exists !!", 400);
            }
            $this->postsRepository->createPost($this->request->all());
            return $this->successResponse("Posts suceessfully created !!", 200);
        } catch (Throwable $th) {
            throw $th;
        }
    }

    public function getAllPosts(): object
    {
        try {
            $result = $this->postsRepository->getPosts();
            if (count($result) === 0) {
                return $this->errorResponse("Data not found !!", 404);
            }
            return $this->successResponse($this->postsRepository->getPosts(), 200);
        } catch (Throwable $th) {
            throw $th;
        }
    }

    public function filterPosts(): object
    {
        try {
            $this->helpers->validateKeys($this->request->query());
            $result = $this->postsRepository->filterPosts($this->request->query());
            if (count($result) === 0) {
                return $this->errorResponse("Data not found !!", 404);
            }
            return $this->successResponse($this->postsRepository->filterPosts($this->request->query()), 200);
        } catch (Throwable $th) {
            throw $th;
        }
    }

    public function updatePost(int $id): object
    {
        try {
            if(count($this->request->input()) === 0){
                return $this->errorResponse("Payload is empty !!", 400);
            }
            $this->helpers->validateKeys($this->request->input());

            $postExists = $this->postsRepository->checkPost(["id" => $id]);
            if (!$postExists) {
                return $this->errorResponse("Post with id $id does not exists !!", 404);
            }

            $this->postsRepository->updatePost($this->request->input(), ["id" => $id]);
            return $this->successResponse("Post with id $id updated sucessfully !", 200);
        } catch (Throwable $th) {
            throw $th;
        }
    }

    public function deletePost(int $id):object
    {
        try{
            $postExists = $this->postsRepository->checkPost(["id" => $id]);
            if (!$postExists) {
                return $this->errorResponse("Post with id $id does not exists !!", 404);
            }

            $this->postsRepository->deletePost(["id"=>$id]);
            return $this->successResponse("Post with id $id deleted successfully !",200);
        }
        catch (Throwable $th){

        }
    }
}
