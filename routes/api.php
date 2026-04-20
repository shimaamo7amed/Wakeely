<?php

use App\Functions\ResponseHelper;
use App\Functions\WhatsApp;
use App\Http\Controllers\BasicController;
use App\Mail\SendOTP;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;


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

Route::prefix('/{lang}')->group(function () {

    Route::any('send-otp/whatsapp/{phone?}', function ($lang) {
        $phone = request('phone');
        $otp = WhatsApp::SendOTP($phone);

        return ResponseHelper::make($otp);
    });
    Route::any('send-otp/email/{email?}', function ($lang) {
        $email = request('email');
        $otp = rand(100000, 999999);
        Mail::to($email)->send(new SendOTP($otp));

        return ResponseHelper::make($otp);
    });
});
Route::get('/home',[BasicController::class, 'appHome']);

Route::fallback(function () {
    return 'Hm, why did you land here somehow?';
});


Route::get('/test-mail', function () {
    Mail::raw('This is a test email', function ($message) {
        $message->to('shimaa0mohamed19@gmail.com')
                ->subject('SMTP Test');
    });

    return 'Mail sent';
});
