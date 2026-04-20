<?php

use Illuminate\Support\Facades\Route;
use Modules\Lawyer\Http\Controllers\APIController;
use Modules\Lawyer\Http\Controllers\APIUpdateController;
use Modules\Lawyer\Http\Controllers\ExperianceController;
use Modules\Lawyer\Http\Controllers\PublicController;

Route::controller(APIController::class)->middleware('setLocale')->group(function () {
    Route::post('onboarding/legal-info', 'store')->middleware('auth:client,sanctum');
    Route::post('onboarding/id-card', 'storeCardID')->middleware('auth:client,sanctum');
    Route::post('onboarding/legal-card', 'storeLegalCard')->middleware('auth:client,sanctum');
});
Route::controller(APIUpdateController::class)->middleware('setLocale')->group(function () {
    Route::patch('onboarding/update-legal-info', 'updateLegalInfo')->middleware('auth:client,sanctum');
    Route::patch('onboarding/update-id-card', 'updateCardID')->middleware('auth:client,sanctum');
    Route::patch('onboarding/update-legal-card', 'updateLegalCard')->middleware('auth:client,sanctum');
});

Route::controller(ExperianceController::class)->middleware('setLocale')->group(function () {
    Route::get('experiance', 'index');
});
Route::controller(PublicController::class)->middleware('setLocale')->group(function () {
    Route::patch('update-legal-info', 'updateLegalInfo')->middleware('auth:client,sanctum');
    Route::patch('update-work-area', 'updateWorkAreas')->middleware('auth:client,sanctum');
    Route::patch('update-expertise','updateExpertises')->middleware('auth:client,sanctum');
});
