<?php

namespace App\Http\Controllers\api\v1\AppointmentSystem;

use App\Models\Plan;
use App\Models\Patient;
use App\Models\Speciality;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentSystem\AvailableSpeciality;
use App\Http\Resources\AvailableSpeciality as ResourcesAvailableSpeciality;

class AvailableSpecialiesController extends Controller
{
    public function getSpecialities(AvailableSpeciality $request){
        if($request->has('contrato')){
                $planID = Patient::find($request->contrato)->plan_id;
                $specialities=ResourcesAvailableSpeciality::collection(Plan::find($planID)->specialities);
        }else{
                $specialities=ResourcesAvailableSpeciality::collection(Speciality::all());
        }
        return response()->json($specialities,200);

    }
}
