<?php

use Illuminate\Support\Facades\Route;
use Modules\Token\Http\Controllers\APIController;

Route::controller(APIController::class)->middleware('setLocale')->group(function () {
    Route::get('/tokens', 'getTokens');
});
