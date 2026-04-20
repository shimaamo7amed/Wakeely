<?php

namespace Modules\Client\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateImageRequest extends FormRequest
{
    public function rules()
    {
        return [

            'image' => ['required', 'image', 'mimes:jpg,png,jpeg,gif,svg'],

        ];
    }

}
