<?php

use Illuminate\Support\Facades\Route;
use Modules\SubAssociations\Http\Controllers\APIController;

Route::controller(APIController::class)->middleware('setLocale')->group(function () {
    Route::get('/sub-associations', 'getSubAssociations');
    Route::get('/bar-association-degrees', 'barAssociationDegrees');
});
