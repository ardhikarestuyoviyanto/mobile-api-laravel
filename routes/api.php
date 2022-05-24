<?php

use App\Http\Controllers\AnonimNewsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SignedNewsControlller;
use App\Http\Controllers\TagController;
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
    Route::get('logout', [AuthController::class, 'logout'])->middleware('jwt.verify');
    Route::resource('user/news', NewsController::class);
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

# Signed Users
Route::group(['middleware'=>'jwt.verify'], function(){
    Route::post('user/news', [SignedNewsControlller::class, 'createnews']);
    Route::get('user/news', [SignedNewsControlller::class, 'getallnews']);
    Route::post('user/news/{id}', [SignedNewsControlller::class, 'updatenews']);
    Route::get('user/news/{id}', [SignedNewsControlller::class, 'getnewsbyid']);
    Route::delete('user/news/{id}', [SignedNewsControlller::class, 'deletenews']);
}); 

# Get Kategori
Route::get('kategori', [KategoriController::class, 'getallkategori']);
# Get Tag
Route::get('tag', [TagController::class, 'getalltag']);