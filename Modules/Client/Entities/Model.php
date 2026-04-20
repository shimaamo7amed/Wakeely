<?php

namespace Modules\Client\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Modules\Address\Entities\Model as Address;
use Modules\Country\Entities\Model as Country;
use Modules\Lawyer\Entities\CardId;
use Modules\Lawyer\Entities\LegalCardId;
use Modules\Notification\Entities\Model as Notification;
use Modules\Order\Entities\Model as Order;
use Modules\RejectReasons\Entities\Model as RejectReason;
use Modules\Token\Entities\TokenWallet;
class Model extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $guarded = [];

    protected $table = 'clients';

    protected $casts = [
        'email_verified_at' =>
        'datetime',
        'password' => 'hashed',
        'rejected_steps' => 'array',
        'is_submitted' => 'boolean',
    ];

    public function Country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function legalProfile()
    {
        return $this->hasOne(\Modules\Lawyer\Entities\LegalProfile::class, 'lawyer_id');
    }
    public function cardId()
    {
        return $this->hasOne(CardId::class, 'lawyer_id');
    }
    public function LegalCardId()
    {
        return $this->hasOne(LegalCardId::class, 'lawyer_id');
    }
    public function rejectionReasons()
    {
        return $this->belongsToMany(RejectReason::class, 'lawyer_rejection_pivot', 'lawyer_id', 'reject_reason_id')
                    ->withPivot('custom_comment')
                    ->withTimestamps();
    }
    public function tokenWallet()
    {
        return $this->hasOne(TokenWallet::class, 'lawyer_id');
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = Str::uuid()->toString();
            }
        });
    }
}
