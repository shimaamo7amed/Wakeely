<?php

use Illuminate\Support\Facades\Route;
use Modules\University\Http\Controllers\APIController;

Route::controller(APIController::class)->middleware('setLocale')->group(function () {
    Route::get('/universities', 'getUniversities');
    Route::get('/degree-types', 'getDegreeTypes');
});
