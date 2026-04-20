<?php
namespace Modules\Lawyer\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class LawyerCardIDRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'front_id_card' => 'required|image|mimes:jpeg,png,jpg,gif',
            'back_id_card'  => 'required|image|mimes:jpeg,png,jpg,gif',
        ];
    }
    public function attributes()
    {
        return [
            'front_id_card' => __('lawyer::messages.front_id_card'),
            'back_id_card' => __('lawyer::messages.back_id_card'),
        ];
    }

}