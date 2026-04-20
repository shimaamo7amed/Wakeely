<?php

use App\Http\Middleware\Localization;
use Illuminate\Support\Facades\Route;
use Modules\Token\Http\Controllers\WebController;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::group(['middleware' => [Localization::class, 'auth:admin']], function () {
        Route::resources(['tokens' => WebController::class]);
        Route::any('datatable-tokens', [WebController::class, 'datatable'])->name('datatable-tokens');
    });
});
