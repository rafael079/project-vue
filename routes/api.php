<?php

use App\Http\Controllers\Api\Content\CategoryController;
use App\Http\Controllers\Api\Content\CommentController;
use App\Http\Controllers\Api\Content\ExternalContentController;
use App\Http\Controllers\Api\Content\PostController;
use App\Http\Controllers\Api\Content\VoteController;
use App\Http\Controllers\Api\User\UserController;
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

# v1 routes
Route::name('v1.')->prefix('v1')->group(function () {
    # Content
    Route::name('posts.')->group(function () {
        # List Posts
        Route::get('posts', [PostController::class, 'index'])->name('list');

        # Auth
        Route::middleware(['auth:sanctum'])->group(function () {
            # Votes
            Route::name('vote.')->prefix('vote')->group(function () {
                Route::post('store', [VoteController::class, 'store'])->name('store');
            });
        });

    });

    # Get External Content
    Route::name('content.')->prefix('content')->group(function () {
        Route::post('url', [ExternalContentController::class, 'getByUrl'])->name('url');
    })->middleware(['auth:sanctum']);

    # Categories
    Route::name('categories.')->group(function () {
        # List Categories
        Route::get('categories', [CategoryController::class, 'index'])->name('list');
    });

    # Comments
    Route::name('comments.')->prefix('comments')->group(function () {
        Route::get('{post_id}', [CommentController::class, 'getByPostId'])->name('getByPostId');
    });

    # Users
    Route::name('users.')->group(function () {
        # Check Users
        Route::get('check-username/{username}', [UserController::class, 'checkIfUsernameExists'])->name('check-username');
        Route::get('check-email/{email}', [UserController::class, 'checkIfEmailExists'])->name('check-email');
    });
});