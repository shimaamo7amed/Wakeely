<?php

namespace Modules\Country\Entities;

use App\Models\BaseModel;

class Model extends BaseModel
{
    protected $guarded = [];

    protected $table = 'countries';
    public function getTitleAttribute()
    {
        return lang() == 'ar' ? $this->name_ar : $this->name_en;
    }

    // protected static function boot()
    // {
    //     parent::boot();
    //     static::retrieved(function ($item) {
    //         $item->currancy_code = $item['currancy_code_'.lang()];
    //     });
    // }
}
