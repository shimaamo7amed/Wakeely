<?php

namespace Modules\Lawyer\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWorkAreasRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'work_areas' => 'required|array|min:1',
            'work_areas.*' => 'exists:governorates,id',
        ];
    }

    public function attributes()
    {
        return [
            'work_areas' => __('lawyer::messages.work_areas'),
        ];
    }
}
