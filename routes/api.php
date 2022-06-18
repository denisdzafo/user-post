<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {

        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::get('/refresh', [AuthController::class, 'refresh']);

        
        Route::middleware('logged')->group(function () {           
            Route::post('/logout', [AuthController::class, 'logout']);

            Route::post('/post/create', [PostController::class, 'createPost']);
            Route::post('/post/edit', [PostController::class, 'editPost']);
            Route::get('/post/delete/{id}', [PostController::class, 'deletePost']);
            
            Route::post('/comment/create', [CommentController::class, 'createComment']);
           
        });
        
    });
    
    Route::get('/posts', [PostController::class, 'getPosts']);
    Route::get('/post/single/{id}', [PostController::class, 'getSinglePost']);


});