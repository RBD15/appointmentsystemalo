<?php

namespace App\Http\Requests\AppointmentSystem\Schedule;

use Illuminate\Foundation\Http\FormRequest;

class GetAvailableRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'contrato'=>'required|integer',
            'speciality_id'=>'required|integer',
            'city_id'=>'nullable|integer',
            'doctor_id'=>'nullable|integer'
        ];
    }
}
