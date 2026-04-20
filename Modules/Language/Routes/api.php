<?php

use Illuminate\Support\Facades\Route;
use Modules\Language\Http\Controllers\APIController;

Route::controller(APIController::class)->middleware('setLocale')->group(function () {
    Route::get('/languages', 'getLanguages');
});
