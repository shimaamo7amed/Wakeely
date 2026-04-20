<?php

use App\Http\Middleware\Localization;
use Illuminate\Support\Facades\Route;
use Modules\AreasPractice\Http\Controllers\WebController;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::group(['middleware' => [Localization::class, 'auth:admin']], function () {
        Route::resources(['areas-of-practice' => WebController::class]);
        Route::any('datatable-areas-of-practice', [WebController::class, 'datatable'])->name('datatable-areas-of-practice');
    });
});
