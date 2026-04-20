<?php

namespace Modules\Language\Entities;



class Language extends \Illuminate\Database\Eloquent\Model
{

    protected $guarded = [];

    protected $table = 'languages';
    
    public function getNameAttribute($value)
    {
        return app()->getLocale() == 'ar' ? $this->name_ar : $this->name_en;
    }

}
