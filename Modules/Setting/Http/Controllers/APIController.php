<?php

namespace Modules\Setting\Http\Controllers;

use App\Functions\ResponseHelper;
use App\Http\Controllers\BasicController;
use Illuminate\Http\Request;

class APIController extends BasicController
{
    public function GoogleAds()
    {
        return ResponseHelper::make(true);
    }

    public function video()
    {
        return ResponseHelper::make(asset(setting('video')));
    }

    public function contact()
    {
        return ResponseHelper::make([
            'contacts' => [
                'phone' => setting('phone'),
                'email' => setting('email'),
                'website' => env('APP_URL'),
            ],
            'contacts' => [
                [
                    'key' => 'phone',
                    'link' => setting('phone'),
                    'icon' => asset('icons/phone.png'),
                ],
                [
                    'key' => 'email',
                    'link' => setting('email'),
                    'icon' => asset('icons/email.png'),
                ],
                [
                    'key' => 'website',
                    'link' => env('APP_URL'),
                    'icon' => asset('icons/website.png'),
                ],
            ],
            'social' => [
                [
                    'key' => 'facebook',
                    'link' => setting('facebook'),
                    'icon' => asset('icons/facebook.png'),
                ],
                [
                    'key' => 'instagram',
                    'link' => setting('instagram'),
                    'icon' => asset('icons/instagram.png'),
                ],
                [
                    'key' => 'tiktok',
                    'link' => setting('tiktok'),
                    'icon' => asset('icons/tiktok.png'),
                ],
                [
                    'key' => 'twitter',
                    'link' => setting('twitter'),
                    'icon' => asset('icons/twitter.png'),
                ],
                [
                    'key' => 'snapchat',
                    'link' => setting('snapchat'),
                    'icon' => asset('icons/snapchat.png'),
                ],
                [
                    'key' => 'linkedin',
                    'link' => setting('linkedin'),
                    'icon' => asset('icons/linkedin.png'),
                ],
            ],
        ]);
    }

        public function index($lang, Request $request)
    {
        $type = $request->type;

        $settings = Settings()->where('type', $type)->get();

        return view('settings.index', compact('settings', 'type'));
    }
}
