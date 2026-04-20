<?php

namespace Modules\Lawyer\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\AreasPractice\Entities\AreaOfPractice;
use Modules\Client\Entities\Model as Lawyer;
use Modules\Governorate\Entities\Model as Governorate;
use Modules\Language\Entities\Language;
use Modules\Lawyer\Entities\Experiance;
use Modules\Lawyer\Entities\LegalQualification;
use Modules\SubAssociations\Entities\BarAssociationDegree;
use Modules\SubAssociations\Entities\SubAssociation;

class LegalProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'lawyer_id',
        'bar_association_id',
        'registration_number',
        'registration_date',
        'sub_associations_id',
        'experience_id',
        'consultation_price',
        'summary',
    ];

    // relations
    public function lawyer()
    {
        return $this->belongsTo(Lawyer::class, 'lawyer_id');
    }

    public function barAssociation()
    {
        return $this->belongsTo(BarAssociationDegree::class, 'bar_association_id');
    }

    public function subAssociation()
    {
        return $this->belongsTo(SubAssociation::class, 'sub_associations_id');
    }

    public function qualifications()
    {
        return $this->hasMany(LegalQualification::class, 'legal_profile_id');
    }

    public function workAreas()
    {
        return $this->belongsToMany(Governorate::class, 'legal_profile_work_area', 'legal_profile_id', 'governorate_id');
    }

    public function expertises()
    {
        return $this->belongsToMany(AreaOfPractice::class, 'legal_profile_expertise', 'legal_profile_id', 'expertise_id');
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class, 'legal_profile_language', 'legal_profile_id', 'language_id');
    }
    public function year_of_experiance()
    {
        return $this->belongsTo(Experiance::class, 'experience_id');
    }
    
}
