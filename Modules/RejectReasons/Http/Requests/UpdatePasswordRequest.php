<?php

namespace Modules\Client\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{
    public function rules()
    {

        return [
                'current_password' => ['required', 'string', 'min:6'],
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