<?php

use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\User\AuthenticatedSessionController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\RegisterController;
use App\Http\Controllers\User\UploadImagesController;
use Illuminate\Support\Facades\Route;
use Momentum\Preflight\PreflightMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['guest'])->group(function () {
    Route::post('register', [RegisterController::class, 'store'])->middleware(PreflightMiddleware::class)->name('register');
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login');
});

# Auth
Route::middleware(['auth:sanctum'])->group(function () {
    # Logout
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    # Users
    Route::name('users.')->prefix('u')->group(function () {
        # Profile
        Route::name('profile.')->prefix('profile')->group(function () {

            Route::patch('update', [ProfileController::class, 'update'])->name('update');

            # Profile Uploads
            Route::name('upload.')->prefix('upload')->group(function () {
                Route::post('cover', [UploadImagesController::class, 'cover'])->name('cover');
                Route::post('avatar', [UploadImagesController::class, 'avatar'])->name('avatar');
            });
        });
    });
});

# Users
Route::name('users.')->prefix('u')->group(function () {
    # Profile
    Route::name('profile.')->group(function () {
        Route::get('{user:username}', [ProfileController::class, 'show'])->name('show');
    });
});

# Images
Route::get('/img/{path}', [ImageController::class, 'show'])->where('path', '.*')->name('image');