<?php


namespace Modules\Client\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    public function rules()
    {
        return [
            'phone' => ['required', 'string'],
            'country_id' => ['required', 'exists:countries,id'],
            'otp' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
                'confirmed'
            ],
        ];
    }
}