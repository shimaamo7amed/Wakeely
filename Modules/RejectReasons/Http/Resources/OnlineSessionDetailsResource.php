<?php

namespace Modules\Client\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OnlineSessionDetailsResource extends JsonResource
{
    public function toArray($request)
    {
        $session = $this->OnlineSession;

        $rates = $session?->sessionRate;
        $count = $rates?->count() ?? 0;
        $avg   = $count ? round($rates->avg('rating'), 1) : 0;

        return [
            'id' => $session->id,
            'title' => $session->title,
            'description' => $session->description,
            'price' => $session->price,
            'duration' => $session->duration,
            'image' => $session->image ? asset($session->image) : null,
            'video' => $session->video_url ? asset($session->video_url) : null,
            'created_at' => $this->OnlineSession->created_at
            ->locale(app()->getLocale())
            ->diffForHumans(),
            'category_title' => $session->category?->title,
            'views' => $session->views ,
            'rate' => $avg ,
            'rates_count' => $count,
            'instructor_name' => $session->instructor?->name,
            'instructor_experience' => $session->instructor?->experience,
            'instructor_image' => $session->instructor?->image
                ? asset($session->instructor->image)
                : null,
        ];
    }
}
