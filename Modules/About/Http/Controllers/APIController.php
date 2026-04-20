<?php

namespace Modules\About\Http\Controllers;

use App\Functions\ResponseHelper;
use App\Http\Controllers\BasicController;
use Modules\About\Entities\Model;

class APIController extends BasicController
{
    public function index()
    {
        $lang = api_lang();

        return ResponseHelper::make(Model::select('title_'.$lang.' AS title', 'desc_'.$lang.' AS desc','icon')->get());
    }
}
