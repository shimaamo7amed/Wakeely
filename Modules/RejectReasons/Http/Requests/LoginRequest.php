<?php

namespace Modules\Client\Http\Requests;

use App\Http\Requests\API\BaseRequest;

class LoginRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'phone' => ['required'],
            'phone_code' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6'],
            'device_token' => ['nullable'],
        ];
    }
}
