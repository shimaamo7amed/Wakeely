<?php

namespace Modules\Client\Http\Requests;

use App\Functions\Upload;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => [
                'required',
                Rule::unique('clients')
                    ->where(function ($query) {
                        return $query->where('phone_code', $this->phone_code)
                                    ->whereNull('deleted_at');
                    })
                    ->ignore($this->route('client')),
            ],
            'phone_code' => ['required'],

        ];
    }

    public function validated($key = null, $default = null)
    {
        $data = parent::validated($key, $default);

        // Handle image upload
        if ($this->hasFile('image')) {
            $data['image'] = Upload::UploadFile($this->file('image'), 'Clients');
        }

        return $data;
    }
}
