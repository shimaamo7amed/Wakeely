<?php

namespace Modules\Client\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => [
                'required', 
                Rule::unique('clients')->where(function ($query) {
                    return $query->where('phone', request('phone'))->where('phone_code', request('phone_code'))->whereNot('id',request('client'));
                }),
            ],
            'phone_code' => ['required', 'string'],
            'password' => ['nullable', 'string', 'min:6'],
        ];
    }
}
