<?php

namespace App\Http\Requests\AppointmentSystem;

use Facade\FlareClient\Http\Response;
use Illuminate\Foundation\Http\FormRequest;

class PatientValidationRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'document'=>'required|integer',
            'phone_number'=>'required|integer'
        ];
    }
}
