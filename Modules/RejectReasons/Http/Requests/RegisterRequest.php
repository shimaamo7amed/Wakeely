<?php

namespace Modules\Client\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', Rule::unique('clients')->where(function ($query) {
                return $query->where('phone', request('phone'))->where('phone_code', request('phone_code'))->whereNull('deleted_at');
            }),
            ],
            'password' => ['required', 'string', 'min:6'],
            'password_confirmation' => ['required', 'string', 'same:password'],
            'device_token' => ['nullable', 'string'],
        ];
    }
}
