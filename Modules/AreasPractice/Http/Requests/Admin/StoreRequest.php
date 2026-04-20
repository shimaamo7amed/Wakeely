<?php

namespace Modules\Client\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => [
                'required', 
                Rule::unique('clients')->where(function ($query) {
                    return $query->where('phone', request('phone'))->where('phone_code', request('phone_code'));
                }),
            ],
            'phone_code' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6'],
        ];
    }
}
