<?php
namespace Modules\Lawyer\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;


class LawyerRegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'bar_association_id' => 'required|exists:bar_association_degrees,id',
            'registration_number' => 'required|string',
            'registration_date' => 'required|date',
            'sub_associations_id' => 'required|exists:sub_associations,id',
            'experience_id' => 'required|exists:years_of_experience,id',
            'consultation_price' => 'required|numeric',
            'summary' => 'required|string',

            // qualifications
            'qualifications' => 'required|array|min:1|max:5',
            'qualifications.*.degree_type_id' => 'required|exists:degree_types,id',
            'qualifications.*.university_id' => 'required|exists:universities,id',
            'qualifications.*.year' => 'required|digits:4',

            // arrays
            'work_areas' => 'required|array|max:2',
            'work_areas.*' => 'exists:governorates,id',

            'expertises' => 'required|array|max:2',
            'expertises.*' => 'exists:areas_of_practice,id',

            'languages' => 'required|array',
            'languages.*' => 'exists:languages,id',
        ];
    }

    public function attributes()
    {
        return [
            // البيانات الأساسية
            'bar_association_id'   => __('lawyer::messages.bar_association'),
            'registration_number'  => __('lawyer::messages.registration_number'),
            'registration_date'    => __('lawyer::messages.registration_date'),
            'sub_associations_id'  => __('lawyer::messages.sub_association'),
            'experience_id'        => __('lawyer::messages.years_of_experience'),
            'consultation_price'   => __('lawyer::messages.consultation_price'),
            'summary'              => __('lawyer::messages.summary'),

            // المؤهلات (Qualifications)
            'qualifications'                  => __('lawyer::messages.qualifications'),
            'qualifications.*.degree_type_id' => __('lawyer::messages.degree_type'),
            'qualifications.*.university_id'  => __('lawyer::messages.university'),
            'qualifications.*.year'           => __('lawyer::messages.graduation_year'),

            // المصفوفات (Arrays)
            'work_areas'   => __('lawyer::messages.work_areas'),
            'work_areas.*' => __('lawyer::messages.work_area'),
            
            'expertises'   => __('lawyer::messages.expertises'),
            'expertises.*' => __('lawyer::messages.expertise'),
            
            'languages'    => __('lawyer::messages.languages'),
            'languages.*'  => __('lawyer::messages.language'),
        ];
    }
}