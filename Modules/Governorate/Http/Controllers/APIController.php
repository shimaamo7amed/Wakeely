<?php

namespace Modules\Governorate\Http\Controllers;

use App\Functions\ResponseHelper;
use App\Http\Controllers\BasicController;
use Modules\Governorate\Entities\Model;

class APIController extends BasicController
{
    public function governorates($id)
    {
        $lang = api_lang();

        // dd($lang);

        $governorate=Model::where('country_id', $id)->get();
        if(!$governorate){
            return ResponseHelper::make(null,__('Governorate::messages.governorate_not_found'),404);
        }
        $governorate=Model::select('id','name_' . $lang .' as name')->where('country_id', $id)->get();
        return ResponseHelper::make($governorate);
    }
}
