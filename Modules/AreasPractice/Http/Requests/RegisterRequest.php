<?php

namespace Modules\Client\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
{
    public function rules()
    {
        $type = $this->input('type');

        return [
            'country_id' => [
                'nullable',
                'exists:countries,id',
                Rule::requiredIf($type === 'user'),
            ],

            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('clients'),
            ],

            'phone' => array_merge(
                ['required', Rule::unique('clients')],
                $type === 'lawyer'
                    ? ['regex:/^(010|011|012|015)[0-9]{8}$/']
                    : []
            ),

            'date_of_birth' => ['required'],

            'terms' => ['required', 'accepted'],

            'type' => ['required', 'in:user,lawyer'],

            'password' => [
                'required',
                'string',
                'min:10',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
                'confirmed',
            ],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'message' => __('trans.failed'),
            'errors' => $validator->errors()
        ], 422));
    }
}
