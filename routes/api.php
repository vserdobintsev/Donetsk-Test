<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
Route::prefix('auth')->group(function () {
    Route::middleware(['guest'])->group(function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
        Route::post('reset', [AuthController::class, 'login']);
    });
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('update-password', [AuthController::class, 'login']);
        Route::post('update-profile', [AuthController::class, 'login']);
        Route::get('logout', [AuthController::class, 'logout']);
    });
});
Route::get('products', [ProductController::class, 'index'])->middleware('auth:sanctum');
