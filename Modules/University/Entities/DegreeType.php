<?php

namespace Modules\University\Entities;

use Illuminate\Database\Eloquent\Model;


class DegreeType extends Model
{

    protected $guarded = [];

    protected $table = 'degree_types';
    public function getNameAttribute($value)
    {
        return app()->getLocale() == 'ar' ? $this->name_ar : $this->name_en;
    }

}
