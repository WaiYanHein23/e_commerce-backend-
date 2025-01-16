<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//authentication
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//get_all_posts
Route::get('/posts', [PostController::class, 'index']);
//get_single_post
Route::get('/posts/{id}', [PostController::class, 'show']);

//get_all_comments
Route::get('/comments', [CommentController::class, 'index']);
//get_single_post
Route::get('/comments/{id}', [CommentController::class, 'show']);


//authorization
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::apiResource('products', ProductController::class);

    //posts
    Route::post('/posts', [PostController::class, 'store']);
    Route::put('/posts/{post}', [PostController::class, 'update']);
    Route::delete('/posts/{post}', [PostController::class, 'destroy']);

    //comments
    Route::post('/comments', [CommentController::class, 'store']);
    Route::put('/comments/{comment}', [CommentController::class, 'update']);
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy']);

      //like
      Route::post('/likes', [LikeController::class, 'store']);
      Route::put('/likes/{like}', [LikeController::class, 'update']);
      Route::delete('/likes/{like}', [LikeController::class, 'destroy']);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
