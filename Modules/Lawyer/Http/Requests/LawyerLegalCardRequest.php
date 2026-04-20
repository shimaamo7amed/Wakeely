<?php
namespace Modules\Lawyer\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class LawyerLegalCardRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'front_legal_card' => 'required|image|mimes:jpeg,png,jpg,gif',
            'back_legal_card' => 'required|image|mimes:jpeg,png,jpg,gif',
        ];
    }
     public function attributes()
    {
        return [
            'front_legal_card' => __('lawyer::messages.front_legal_card'),
            'back_legal_card' => __('lawyer::messages.back_legal_card'),
        ];
    }
}