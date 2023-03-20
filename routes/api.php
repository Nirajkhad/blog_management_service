<?php

use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->prefix('/posts')->group(function(){
    Route::post('/',[PostController::class,'addPost']);
    Route::get('/',[PostController::class,'getAllPosts']);
    Route::get('/filter',[PostController::class,'filterPosts']);
    Route::put('/{id}',[PostController::class,'updatePost']);
    Route::delete('/{id}',[PostController::class,'deletePost']);
});

