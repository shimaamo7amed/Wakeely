<?php
namespace Modules\Lawyer\Entities;

use Illuminate\Database\Eloquent\Model;

class Experiance extends Model
{
    protected $fillable = [
        'title',
    ];
    protected $table = 'years_of_experience';
}
