<?php

use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\User\AuthenticatedSessionController;
use App\Http\Controllers\User\RegisterController;
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
