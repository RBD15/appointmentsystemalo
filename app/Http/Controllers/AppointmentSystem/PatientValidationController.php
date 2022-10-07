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
                return response()->json(['message'=>'Patient Authorizated','name'=>$result->name,'plan'=>$result->plan_id],200);
            }
        }

        return response()->json(['message'=>'Patient Unauthorizated'],401);
    }
}
