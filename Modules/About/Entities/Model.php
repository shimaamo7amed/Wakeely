<?php

namespace Modules\About\Entities;

use App\Models\BaseModel;

class Model extends BaseModel
{
    protected $guarded = [];

    protected $table = 'about';
    public function getNameAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->title_ar : $this->title_en;
    }
}
