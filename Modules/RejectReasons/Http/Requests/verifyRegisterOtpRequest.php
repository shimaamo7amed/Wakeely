<?php

namespace Modules\Client\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class verifyRegisterOtpRequest extends FormRequest
{
    public function rules()
    {
        return [
            'phone'        => 'required|min:6',
            'phone_code'   => 'required|string',
            'otp'          => 'required|digits:6',
            'device_token' => 'nullable|string',
        ];
    }
}
