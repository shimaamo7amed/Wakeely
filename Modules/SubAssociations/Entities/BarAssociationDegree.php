<?php
namespace Modules\SubAssociations\Entities;

use Illuminate\Database\Eloquent\Model;
class BarAssociationDegree extends Model
{
    protected $guarded = [];

    protected $table = 'bar_association_degrees';
    public function getNameAttribute($value)
    {
        return app()->getLocale() == 'ar' ? $this->name_ar : $this->name_en;
    }
    
}