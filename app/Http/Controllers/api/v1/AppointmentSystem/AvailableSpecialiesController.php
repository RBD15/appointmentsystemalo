<?php

namespace App\Http\Controllers\api\v1\AppointmentSystem;

use App\Models\Plan;
use App\Models\Speciality;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentSystem\AvailableSpeciality;
use App\Http\Resources\AvailableSpeciality as ResourcesAvailableSpeciality;

class AvailableSpecialiesController extends Controller
{
    public function getSpecialities(AvailableSpeciality $request){
        if($request->has('contrato')){
                $specialities=ResourcesAvailableSpeciality::collection(Plan::find($request->contrato)->specialities);
        }else{
                $specialities=ResourcesAvailableSpeciality::collection(Speciality::all());                
        }
        return response()->json($specialities,200);
  
    }
}
