<?php
namespace Modules\Client\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ForgetPasswordRequest extends FormRequest

{
    public function rules()
    {
        return [
            'email' => 'required|email',
        ];
    }
}