<?php

namespace Modules\Client\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class ProfileResource extends JsonResource
{
    public function toArray($request): array
    {
        $data = [
            'first_name' => $this->first_name,
            'last_name'  => $this->last_name,
            'phone'      => $this->phone,
            'avatar'     => $this->image ?? asset($this->image),
            'role'       => $this->type,
            'connects' => $this->when(
                $this->type === 'lawyer',
                $this->tokenWallet?->free_balance ?? 0
            ),
        ];

        if ($this->type === 'user') {
            $data['country'] = $this->country;
        }



        return $data;
    }
}
