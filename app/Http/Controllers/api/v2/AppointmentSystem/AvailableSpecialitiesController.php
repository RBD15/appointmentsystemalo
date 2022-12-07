<?php

namespace App\Http\Controllers\api\v2\AppointmentSystem;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Speciality;
use App\Http\Requests\AppointmentSystem\AvailableSpeciality;
use App\Http\Resources\AvailableSpeciality as ResourcesAvailableSpeciality;

class AvailableSpecialitiesController extends Controller
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
