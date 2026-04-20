<?php

use App\Http\Middleware\Localization;
use Illuminate\Support\Facades\Route;
use Modules\SubAssociations\Http\Controllers\WebController;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::group(['middleware' => [Localization::class, 'auth:admin']], function () {
        Route::resources(['sub-associations' => WebController::class]);
        Route::any('datatable-sub-associations', [WebController::class, 'datatable'])->name('datatable-sub-associations');
    });
});
