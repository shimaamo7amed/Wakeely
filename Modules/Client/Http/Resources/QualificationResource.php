<?php
namespace Modules\Client\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Client\Http\Resources\DegreeTypeResource;
use Modules\Client\Http\Resources\UniversityResource;

class QualificationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'          => $this->id,
            'year'        => $this->year,
            'degree_type' => new DegreeTypeResource($this->whenLoaded('degreeType')),
            'university'  => new UniversityResource($this->whenLoaded('university')),
        ];
    }
}