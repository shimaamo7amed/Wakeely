<?php
namespace Modules\Lawyer\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Lawyer\Entities\LegalProfile;
use Modules\University\Entities\DegreeType;
use Modules\University\Entities\University;

class LegalQualification extends Model
{
    use HasFactory;

    protected $fillable = [
        'legal_profile_id',
        'degree_type_id',
        'university_id',
        'year',
    ];

    public function legalProfile()
    {
        return $this->belongsTo(LegalProfile::class);
    }

    public function degreeType()
    {
        return $this->belongsTo(DegreeType::class);
    }

    public function university()
    {
        return $this->belongsTo(University::class);
    }
}