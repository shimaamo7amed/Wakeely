<?php
namespace Modules\Lawyer\Entities;

use Illuminate\Database\Eloquent\Model;

class CardId extends Model
{
        protected $fillable = [
            'lawyer_id',
            'front_id_card',
            'back_id_card',
        ];
    protected $table = 'card_id';
}