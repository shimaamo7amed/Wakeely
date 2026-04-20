<?php
namespace Modules\Client\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyForgetOtpRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email',
            'otp'   => 'required',
        ];
    }
}