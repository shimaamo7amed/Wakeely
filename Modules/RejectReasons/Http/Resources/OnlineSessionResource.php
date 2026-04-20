<?php

namespace Modules\Client\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OnlineSessionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->OnlineSession->id,
            'title' => $this->OnlineSession->title,
            'price' => $this->OnlineSession->price,
            'duration' => $this->OnlineSession->duration,
            'image' => $this->OnlineSession->image ? asset($this->OnlineSession->image) : null,
            'created_at' => $this->OnlineSession->created_at
            ->locale(app()->getLocale())
            ->diffForHumans(),
            'views' => $this->OnlineSession->views ,
            'category_title' => $this->OnlineSession->category?->title,

        ];
    }
}
