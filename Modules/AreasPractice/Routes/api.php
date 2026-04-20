<?php

use Illuminate\Support\Facades\Route;
use Modules\AreasPractice\Http\Controllers\APIController;

Route::controller(APIController::class)->middleware('setLocale')->group(function () {
    Route::get('/areas-of-practice', 'getAreasOfPractice');
});
