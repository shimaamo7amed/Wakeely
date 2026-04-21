<?php

namespace Modules\Client\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Client\Http\Resources\ExpertiseResource;
use Modules\Client\Http\Resources\LanguageResource;
use Modules\Client\Http\Resources\QualificationResource;
use Modules\Client\Http\Resources\WorkAreaResource;
use Modules\Client\Http\Resources\YearOfExperienceResource;

class LegalProfileResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'work_areas'         => WorkAreaResource::collection($this->whenLoaded('workAreas')),
            'expertises'         => ExpertiseResource::collection($this->whenLoaded('expertises')),
            'qualifications'     => QualificationResource::collection($this->whenLoaded('qualifications')),
            'years_experience' => new YearOfExperienceResource($this->whenLoaded('year_of_experiance')),
            'consultation_price' => $this->consultation_price,
            'languages'          => LanguageResource::collection($this->whenLoaded('languages')),
            'bio'                => $this->bio,
        ];
    }
}