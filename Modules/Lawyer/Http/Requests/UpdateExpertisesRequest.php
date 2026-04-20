<?php

namespace Modules\Lawyer\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExpertisesRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'expertises'   => 'required|array|min:1',
            'expertises.*' => 'exists:areas_of_practice,id',
        ];
    }

    public function attributes()
    {
        return [
            'expertises' => __('lawyer::messages.expertises'),
        ];
    }
}
