<?php

namespace Modules\Client\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\SessionOrder\Entities\Model as SessionOrder;

class SessionResource extends JsonResource
{
    public function toArray($request)
    {
        $paidSessions = $request->get('paid_sessions', []);

        $session = $this->onlineSession;

        return [
            'id' => $session->id,
            'title' => $session->title,
            'price' => number_format($session->price, 3, '.', '') .' '.'BD',
            'duration' => $session->duration,
            'image' => $session->image ? asset($session->image) : null,
            'video_url' => in_array($session->id, $paidSessions) 
                ? $session->video_url 
                : null,

            'created_at' => $session->created_at?->diffForHumans(),
            'is_favourite' => $this->is_favourite,
            'views' => $session->views ,
            'category_title' => $session->category?->title,
        ];
    }
}
