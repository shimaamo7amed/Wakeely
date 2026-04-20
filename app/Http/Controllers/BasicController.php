<?php

namespace App\Http\Controllers;

use App\Functions\ResponseHelper;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
class BasicController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $Client;

    public function __construct()
    {
        app()->setLocale(request()->lang ?? 'en');
    }

    public function CheckAuth()
    {
        if (! auth('sanctum')->check()) {
            return ResponseHelper::make([], __('trans.You not auth'), true, 404);
        } else {
            $this->Client = auth('sanctum')->user();
        }
    }

    public function CheckCount($Data)
    {
        if ($Data->count() < 1) {
            return ResponseHelper::make([], __('trans.Data not found'), true, 404);
        }
    }

    public function CheckExist($Model)
    {
        if (! $Model) {
            return ResponseHelper::make((object) [], __('trans.Data not found'), true, 404);
        }
    }
    public function appHome()
    {
        $settings = Settings()
            ->whereIn('key', ['phone', 'logo', 'email'])
            ->pluck('value', 'key');

        return ResponseHelper::make($settings);
    }
}
