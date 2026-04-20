<?php

namespace Modules\City\Http\Controllers;

use App\Functions\ResponseHelper;
use App\Http\Controllers\BasicController;
use Modules\City\Entities\Model;

class APIController extends BasicController
{
    public function cities($lang, $id)
    {
        $cities=Model::where('governorate_id', $id)->get();
        if(!$cities){
            return ResponseHelper::make(null,__('City::messages.city_not_found'),404);
        }
        $cities=Model::select('id','name_' . lang().' as title')->where('governorate_id', $id)->get();
        return ResponseHelper::make($cities);
    }
    
}
