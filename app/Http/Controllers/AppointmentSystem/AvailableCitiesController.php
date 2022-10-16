<?php

namespace App\Http\Controllers\AppointmentSystem;

use App\Models\City;
use App\Models\Speciality;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AvailableCitiesController extends Controller
{
    public function getCities(Request $request){
        if($request->has('contrato') && $request->has('speciality_id')){
            $specialityArray=Speciality::find($request->speciality_id)->doctors->toArray();
            $doctorsID=array();
            foreach ($specialityArray as $key => $value) {
                array_push($doctorsID,$value['id']);
            }
            $availableAppointmentsaArray=Appointment::whereIn('doctor_id',$doctorsID)->where('patient_id',1)->get()->pluck('city')->toArray();
            $citiesId=array();
            foreach ($availableAppointmentsaArray as $key => $value) {
                if(array_search($value['id'],$citiesId)===false){
                    array_push($citiesId,$value['id']);
                }
            }
            $cities=City::find($citiesId);
            return response()->json($cities,200);
        }  
        return response()->json(['message'=>'Bad request'],401); 
    }
}
