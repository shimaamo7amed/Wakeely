<?php

namespace Modules\Governorate\Entities;

use App\Models\BaseModel;
use Modules\City\Entities\Model as City;
use Modules\Country\Entities\Model as Country;
class Model extends BaseModel
{
    protected $guarded = [];

    protected $table = 'governorates';

    public function getTitleAttribute()
    {
        return app()->getLocale() === 'ar' ? $this->name_ar : $this->name_en;

    }
    public function cities()
    {
        return $this->hasMany(City::class,'governorate_id');
    }
    public function country()
    {
        return $this->belongsTo(Country::class,'country_id');
    }
}
