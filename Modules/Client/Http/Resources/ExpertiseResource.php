<?php
namespace Modules\Client\Http\Resources;

use App\Traits\TranslatesName;
use Illuminate\Http\Resources\Json\JsonResource;

// ExpertiseResource
class ExpertiseResource extends JsonResource
{
    use TranslatesName;

    public function toArray($request): array
    {
        return [
            'id'   => $this->id,
            'name' => $this->translatedName(),
        ];
    }
}