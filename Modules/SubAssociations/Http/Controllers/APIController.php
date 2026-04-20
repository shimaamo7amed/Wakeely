<?php

namespace Modules\SubAssociations\Http\Controllers;

use App\Functions\ResponseHelper;
use App\Http\Controllers\BasicController;



class APIController extends BasicController
{
    public $lang;

    public function __construct()
    {
        $this->lang = api_lang();
    }

    private function getLang()
    {
        return in_array($this->lang, ['ar', 'en']) ? $this->lang : 'en';
    }

    public function getSubAssociations()
    {
        $lang = $this->getLang();

        $subAssociations = \Modules\SubAssociations\Entities\Model::select(
            'id',
            'name_' . $lang . ' AS name'
        )->get();

        return ResponseHelper::make($subAssociations);
    }
    public function barAssociationDegrees()
    {
    
        $lang = $this->getLang();

        $barAssociationDegrees = \Modules\SubAssociations\Entities\barAssociationDegrees::select(
            'id',
            'name_' . $lang . ' AS name'
        )->get();

        return ResponseHelper::make($barAssociationDegrees);
    }

}
