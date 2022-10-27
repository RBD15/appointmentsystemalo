<?php

namespace App\Http\Requests\AppointmentSystem\Schedule;

use Illuminate\Foundation\Http\FormRequest;

class SetAppointmentRequest extends FormRequest
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
            'appointment_id'=>'required|integer',
        ];
    }
}
