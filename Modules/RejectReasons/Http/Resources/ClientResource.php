<?php

namespace Modules\Client\Http\Resources;

use App\Http\Resources\BaseResource;
use Modules\Country\Entities\Model as Country;

class ClientResource extends BaseResource
{
    public function toArray($request)
    {
        $country = Country::where('phone_code', $this->phone_code)->first();
        $lang = $request->route();
        $arr = [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => '+'.$this->full_phone,
            'image' => $this->image ? asset($this->image) : null,
            'country' => $country ? (object)[
                'id' => $country->id,
                'name' => $country->{'title_'.lang()},
                'phone_code' => $country->phone_code,
                'country_code' => $country->country_code,
                'currancy_code' => $country->currancy_code,
            ] : null
        ];

        return (object) $arr;
    }
}
