<?php

use App\Http\Controllers\AnonimNewsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index']);

# Auth
Route::prefix('auth')->group(function(){
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});

# Anonim Users
# News
Route::get('news', [AnonimNewsController::class, 'getallnews']);
Route::get('news/{id}', [AnonimNewsController::class, 'getnewsbyid']);
# Comment
Route::post('comment', [CommentController::class, 'create']);
# Like
Route::post('like', [LikeController::class, 'create']);
# Search News
Route::prefix('search')->group(function(){
    # By Kategori ID
    Route::get('kategori/{id}', [SearchController::class, 'getnewsbykategori']);
    # By Tag Name
    Route::get('tag', [SearchController::class, 'getnewsbytagname']);
});
