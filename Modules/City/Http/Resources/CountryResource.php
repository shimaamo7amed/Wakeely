<?php

namespace Modules\Country\Http\Resources;

use App\Http\Resources\BaseResource;

class CountryResource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title(),
            'image' => asset($this->image),
        ];
    }
}
