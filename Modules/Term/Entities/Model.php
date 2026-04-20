<?php

namespace Modules\Term\Entities;

use App\Models\BaseModel;

class Model extends BaseModel
{
    protected $guarded = [];

    protected $table = 'terms';
    protected $casts = [
        'sections_ar' => 'array',
        'sections_en' => 'array',
    ];
}
