<?php

use Illuminate\Support\Facades\Route;
use Modules\Client\Http\Controllers\APIController;

Route::prefix('auth')->controller(APIController::class)->middleware('setLocale')->group(function () {
    Route::POST('register', 'register');
    Route::POST('email-verify', 'verifyOtp');
    Route::POST('sign-in', 'Login');
    Route::POST('forget-password', 'forgetPassword');
    Route::POST('verify-forget-otp', 'verifyForgetPasswordOtp');
    Route::POST('reset-password', 'resetPassword');
    Route::get('me', 'userAuth')->middleware('auth:client,sanctum');
    Route::PATCH('change-password', 'updatePassword')->middleware('auth:client,sanctum');

 
    Route::middleware('auth:client,sanctum')->group(function () {
        Route::GET('profile', 'profile');
        Route::PATCH('updatePassword', 'updatePassword');
        Route::POST('delete-account', 'DeleteAccount');
        Route::POST('logout', 'Logout');
        Route::PATCH('update/image', 'updateImage');
        Route::PATCH('update/profile', 'updateProfile');
        Route::post('verify-email-otp', 'verifyEmailUpdate');
     });
});
