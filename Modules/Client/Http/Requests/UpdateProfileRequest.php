<?php

namespace Modules\Client\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    public function rules()
    {

$clientId = auth('client')->id();
dd($clientId);
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => [
    'required',
    'string',
    'max:20',
    Rule::unique('clients', 'phone')->ignore($clientId),
],
'email' => [
    'required',
    'string',
    'email',
    'max:255',
    Rule::unique('clients', 'email')->ignore($clientId),
],
        ];
    }

}
