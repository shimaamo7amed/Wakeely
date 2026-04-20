<?php

namespace Modules\Lawyer\Http\Controllers;

use App\Functions\ResponseHelper;
use App\Http\Controllers\BasicController;
use Modules\Lawyer\Entities\Experiance;

class ExperianceController extends BasicController
{
    public function index()
{
    $lang = api_lang();

    $experiences = Experiance::select('id', 'title')->get()->map(function ($item) use ($lang) {

        $item->title = $lang == 'ar'
            ? $item->title . ' سنة'
            : $item->title . ' years';

        return $item;
    });

    return ResponseHelper::make($experiences);
}
}