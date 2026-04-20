<?php

namespace Modules\AreasPractice\Http\Controllers;

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

    public function getAreasOfPractice()
    {
        $lang = $this->getLang();

        $areasOfPractice = \Modules\AreasPractice\Entities\Model::select(
            'id',
            'name_' . $lang . ' AS name'
        )->get();

        return ResponseHelper::make($areasOfPractice);
    }

}
