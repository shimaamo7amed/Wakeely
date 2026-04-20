<?php

namespace Modules\City\Entities;

use App\Models\BaseModel;
use Modules\Governorate\Entities\Model as Governorate;

class Model extends BaseModel
{
    protected $guarded = [];

    protected $table = 'cities';

    public function governorate()
    {
        return $this->belongsTo(Governorate::class);
    }
    public function getNameAttribute()
    {
       return app()->getLocale() === 'ar' ? $this->name_ar : $this->name_en;
    }
}
