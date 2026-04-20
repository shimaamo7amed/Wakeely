<?php
namespace Modules\Lawyer\Entities;

use Illuminate\Database\Eloquent\Model;

class LegalCardId extends Model
{
        protected $fillable = [
            'lawyer_id',
            'front_legal_card',
            'back_legal_card',
        ];
    protected $table = 'legal_card';
}