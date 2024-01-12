<?php

use App\Http\Controllers\Api\Content\PostController;
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
    });

    # Users
    Route::name('users.')->group(function () {
        # Check Users
        Route::get('check-username/{username}', [UserController::class, 'checkIfUsernameExists'])->name('check-username');
        Route::get('check-email/{email}', [UserController::class, 'checkIfEmailExists'])->name('check-email');
    });
});