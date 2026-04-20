<?php

namespace Modules\AreasPractice\Entities;



class AreaOfPractice extends \Illuminate\Database\Eloquent\Model
{

    protected $guarded = [];

    protected $table = 'areas_of_practice';
    public function legalProfiles()
    {
        return $this->belongsToMany(\Modules\Lawyer\Entities\LegalProfile::class, 'legal_profile_expertise', 'expertise_id', 'legal_profile_id');
    }
    public function getNameAttribute($value)
    {
        return app()->getLocale() == 'ar' ? $this->name_ar : $this->name_en;
    }

}
