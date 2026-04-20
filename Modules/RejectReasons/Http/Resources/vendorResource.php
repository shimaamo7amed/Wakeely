<?php
namespace Modules\Client\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use Modules\Review\Entities\Model as Review;

class vendorResource extends JsonResource
{
    
    public function toArray($request)
    {

        $vendor = $this->vendor;

        $reviews = $vendor->teams->flatMap->reviews;

        $count = $reviews->count();
        $avg   = $count ? round($reviews->avg('rate'), 1) : 0;
        


        return [
            'id' => $vendor->id,
            'title' => $vendor->title,
            'description' => $vendor->description,
            'image' => $vendor->image ? asset($vendor->image) : null,

            'service_count' => count($vendor->services) ,

            'is_favourite' => $this->is_favourite,
            'category_title' => $vendor->categories->pluck('title')->implode(', '),
            'rate' => $reviews->count()
                ? round($reviews->avg('rate'), 1)
                : 0,

            'rate_count' => $reviews->count(),
        ];
    }
}