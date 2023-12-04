<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Middleware\VerifyPostAuthor;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\BookmarkController;

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

Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('comments', CommentController::class);
    Route::apiResource('posts', PostController::class)->except([
        'destroy'
    ]);

    Route::delete('posts/{post}', [PostController::class, 'destroy'])
    ->middleware('verifyPostAuthor');


    Route::get('/bookmarks', [BookmarkController::class, 'index']);
    Route::post('/bookmarks/{postId}', [BookmarkController::class, 'store']);
    Route::delete('/bookmarks/{postId}', [BookmarkController::class, 'destroy']);
    // Route::apiResource('bookmarks', BookmarkController::class);
});
