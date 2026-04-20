<?php

namespace Modules\Term\Http\Controllers;

use App\Functions\ResponseHelper;
use App\Http\Controllers\BasicController;
use Modules\Term\Entities\Model;

class APIController extends BasicController
{
    public function index()
    {
        $lang = api_lang();

        $terms = Model::orderBy('arrangement', 'asc')
            ->get()
            ->map(function ($term) use ($lang) {

                $sections = $lang === 'en'
                    ? $term->sections_en
                    : $term->sections_ar;

                return [
                    "slug" => $term->slug,
                    "sections" => $sections
                ];
            });

        return ResponseHelper::make($terms);
    }
}
