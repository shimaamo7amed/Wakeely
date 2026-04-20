<?php

namespace Modules\Lawyer\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublicUpdateLegalRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'consultation_price' => 'required|numeric',
            'languages' => 'required|array',
            'languages.*' => 'exists:languages,id',
            'summary' => 'required|string',
            'years_of_experience_id' => 'required|exists:years_of_experience,id',
        ];
    }

    public function attributes()
    {
        return [
            'consultation_price' => __('lawyer::messages.consultation_price'),
            'languages' => __('lawyer::messages.languages'),
            'summary' => __('lawyer::messages.summary'),
            'experience_id' => __('lawyer::messages.years_of_experience'),
        ];
    }
}
