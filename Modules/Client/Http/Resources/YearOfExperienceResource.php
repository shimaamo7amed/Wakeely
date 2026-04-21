<?php

namespace Modules\Client\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class YearOfExperienceResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'    => $this->id,
            'title' => $this->title,
        ];
    }
}
