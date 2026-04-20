<?php

namespace Modules\Client\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyRegisterRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email'        => 'required|email',
            'otp'          => 'required|digits:6',
        ];
    }
}
