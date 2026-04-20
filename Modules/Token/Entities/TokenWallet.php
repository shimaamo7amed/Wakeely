<?php
namespace Modules\Token\Entities;

use Illuminate\Database\Eloquent\Model;
class TokenWallet extends Model
{

    protected $guarded = [];

    protected $table = 'client_tokens';

    protected $casts = [
        'free_expires_at' => 'datetime',
    ];

}