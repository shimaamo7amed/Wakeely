<?php

namespace Modules\Admin\Entities;

use App\Traits\Status;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Model extends Authenticatable
{
    use HasApiTokens, HasRoles, Notifiable, Status;

    protected $guarded = [];

    protected $table = 'admins';

    protected $hidden = ['password', 'remember_token'];

    public static function boot()
    {
        parent::boot();
        static::created(function ($model) {
            $model->uuid = Str::uuid()->toString();
            $model->save();
        });
    }
}
