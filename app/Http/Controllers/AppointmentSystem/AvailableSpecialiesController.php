<?php

namespace App\Http\Controllers\AppointmentSystem;

use App\Models\Plan;
use App\Models\Speciality;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AvailableSpecialiesController extends Controller
{
    public function getSpecialities(Request $request){
        if($request->has('contrato')){
            if($request->has('contrato')){
                $specialities=Plan::find($request->contrato)->specialities;
            }else{
                $specialities=Speciality::all();                
            }
            return response()->json($specialities,200);
        }  
        return response()->json(['message'=>'Bad request'],401);    
    }
}
