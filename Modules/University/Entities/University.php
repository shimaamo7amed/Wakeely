<?php

namespace Modules\University\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class University extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $guarded = [];

    protected $table = 'universities';
    public function getNameAttribute($value)
    {
        return app()->getLocale() == 'ar' ? $this->name_ar : $this->name_en;
    }

}
