<?php

use App\Http\Controllers\Auth\Jwt\LoginController;
use App\Http\Controllers\Auth\Jwt\LogoutController;
use App\Http\Controllers\Auth\Jwt\ProfileController;
use App\Http\Controllers\Auth\Jwt\RefreshTokenController;
use App\Http\Controllers\Auth\Jwt\RegisterController;
use App\Http\Controllers\Auth\VerifyUserEmailController;
use App\Http\Controllers\Photo\PhotoCategoryController;
use App\Http\Controllers\Photo\PhotoController;
use App\Http\Controllers\Photo\PhotoTagController;
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

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);

Route::group([
    'middleware' => ['auth:api']
], function() {
    Route::get('profile', [ProfileController::class, 'profile']);
    Route::get('refresh-token', [RefreshTokenController::class, 'refresh']);
    Route::get('logout', [LogoutController::class, 'logout']);
    Route::post('verify-email', [VerifyUserEmailController::class, 'verifyUserEmail']);
    Route::post('resend-email-verification-link', [VerifyUserEmailController::class, 'resendEmailVerificationLink']);

    Route::apiResource('photo', PhotoController::class);
    Route::apiResource('photo-category', PhotoCategoryController::class);
    Route::apiResource('photo-tag', PhotoTagController::class);
});
