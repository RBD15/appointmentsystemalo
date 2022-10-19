<?php

namespace App\Http\Controllers\AppointmentSystem;

use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentSystem\PatientValidationRequest;

class PatientValidationController extends Controller
{
    public function validationUser(PatientValidationRequest $request){
        $result=Patient::where('document','=',$request->document)->get()->first();
        if($result->phone_number==$request->phone_number){
            return response()->json(['message'=>'Patient Authorizated','contrato'=>$result->id,'name'=>$result->name,'age'=>$result->age,'address'=>$result->address,'phone_number'=>$result->phone_number,'plan'=>$result->plan_id,'status'=>$result->status],200);
        }
        return response()->json(['message'=>'Patient Unauthorizated'],401);
    }
}
