<?php

use App\Http\Middleware\Localization;
use Illuminate\Support\Facades\Route;
use Modules\Lawyer\Http\Controllers\WebController;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::group(['middleware' => [Localization::class, 'auth:admin']], function () {
        Route::resources(['lawyers' => WebController::class]);
        Route::any('datatable-lawyers', [WebController::class, 'datatable'])->name('datatable-lawyers');
    });
});
