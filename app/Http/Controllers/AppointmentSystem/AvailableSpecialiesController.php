<?php

namespace App\Http\Controllers\AppointmentSystem;

use App\Models\Plan;
use App\Models\Speciality;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentSystem\AvailableSpeciality;

class AvailableSpecialiesController extends Controller
{
    public function getSpecialities(AvailableSpeciality $request){
        if($request->has('contrato')){
                $specialities=Plan::find($request->contrato)->specialities;
        }else{
                $specialities=Speciality::all();                
        }
        return response()->json($specialities,200);
  
    }
}
