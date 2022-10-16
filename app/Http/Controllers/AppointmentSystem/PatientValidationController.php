<?php

namespace App\Http\Controllers\AppointmentSystem;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientValidationController extends Controller
{
    public function validationUser(Request $request){
        if($request->has('document') && $request->has('phone_number')){
            $result=Patient::where('document','=',$request->document)->get()->first();
            if($result->phone_number==$request->phone_number){
                return response()->json(['message'=>'Patient Authorizated','contrato'=>$result->id,'name'=>$result->name,'age'=>$result->age,'address'=>$result->address,'phone_number'=>$result->phone_number,'plan'=>$result->plan_id,'status'=>$result->status],200);
            }
        }
        return response()->json(['message'=>'Patient Unauthorizated'],401);
    }
}
