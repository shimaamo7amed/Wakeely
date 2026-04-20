<?php

namespace Modules\University\Http\Controllers;

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

    public function getUniversities()
    {
        $lang = $this->getLang();

        $universities = \Modules\University\Entities\University::select(
            'id',
            'name_' . $lang . ' AS name'
        )->get();

        return ResponseHelper::make($universities);
    }

    public function getDegreeTypes()
    {
        $lang = $this->getLang();

        $degreeTypes = \Modules\University\Entities\DegreeType::select(
            'id',
            'name_' . $lang . ' AS name'
        )->get();

        return ResponseHelper::make($degreeTypes);
    }
}
