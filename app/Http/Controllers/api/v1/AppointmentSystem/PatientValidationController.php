<?php

namespace App\Http\Controllers\api\v1\AppointmentSystem;

use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentSystem\PatientValidationRequest;
use App\Http\Resources\PatientValidation;

class PatientValidationController extends Controller
{
    public function validationUser(PatientValidationRequest $request){
        $patient=Patient::where('document','=',$request->document)->get();
        $result=PatientValidation::collection($patient);
        if($patient->first()->phone_number==$request->phone_number){
            return response()->json(['message'=>'Patient Authorizated',"patient"=>$result],200);
        }
        return response()->json(['message'=>'Patient Unauthorizated'],401);
    }
}
