<?php

namespace Modules\Faq\Http\Controllers;

use App\Functions\ResponseHelper;
use App\Http\Controllers\BasicController;
use Modules\Faq\Entities\Model;

class APIController extends BasicController
{
    public function index()
    {
        $lang = api_lang();


        $model = Model::select(
            'question_' . $lang . ' AS question',
            'answer_' . $lang . ' AS answer',
        )->get();

        return ResponseHelper::make($model);
    }
}