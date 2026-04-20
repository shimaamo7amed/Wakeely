<?php

use Illuminate\Support\Facades\Route;
use Modules\Contact\Http\Controllers\APIController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::POST('contact-us', [APIController::class, 'store'])->name('api.contact.store');
