<?php

namespace Modules\SubAssociations\Entities;



class SubAssociation extends \Illuminate\Database\Eloquent\Model
{

    protected $guarded = [];

    protected $table = 'sub_associations';
    public function legalProfiles()
    {
        return $this->hasMany(\Modules\Lawyer\Entities\LegalProfile::class, 'sub_associations_id');
    }
    public function getNameAttribute($value)
    {
        return app()->getLocale() == 'ar' ? $this->name_ar : $this->name_en;
    }

}
