<?php

namespace Modules\Client\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UpdatePassRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    // public function rules()
    // {
    //     return [
    //         'current_password' => ['required', 'current_password'],

    //         'password' => ['required', 'string', 'min:6',
    //             'regex:/[a-z]/',
    //             'regex:/[A-Z]/',
    //             'regex:/[0-9]/',
    //             'regex:/[@$!%*#?&]/',
    //             'confirmed'
    //         ],
    //     ];
    // }

    public function rules()
    {
        return [
            'current_password' => ['required', 'current_password'],

            'password' => [
                'required',
                'string',
                'min:6',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
                'confirmed',
                function ($attribute, $value, $fail) {
                    if (Hash::check($value, auth('client')->user()->password)) {
                        $fail(__('trans.MustnotbeSame'));
                    }
                }
            ],
        ];
    }
}
