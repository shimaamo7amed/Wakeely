<?php

use App\Http\Middleware\Localization;
use Illuminate\Support\Facades\Route;
use Modules\University\Http\Controllers\WebController;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::group(['middleware' => [Localization::class, 'auth:admin']], function () {
        Route::resources(['university' => WebController::class]);
        Route::any('datatable-university', [WebController::class, 'datatable'])->name('datatable-university');
    });
});
