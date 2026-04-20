<?php

namespace Modules\Country\Http\Controllers;

use App\Functions\ResponseHelper;
use App\Http\Controllers\BasicController;
use Modules\Country\Entities\Model;

class APIController extends BasicController
{
    public function countries()
    {
        $lang = api_lang();

        // dd($lang);

        $countries = Model::select(
            'id',
            "name_$lang as name",
            'code',
            'flag'
        )
            ->get();

        return ResponseHelper::make($countries);
    }
}
