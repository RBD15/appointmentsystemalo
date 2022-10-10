<?php

namespace App\Http\Controllers\AppointmentSystem;

use App\Models\Patient;
use App\Models\Speciality;
use App\Models\Appointment;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AvailableAppointmentsResource;

class ScheduleAppointmentsController extends Controller
{
    public function getAvailableAppointments(Request $request){

        if($request->has('doctor_id') && $request->has('speciality_id') && $request->has('city_id')){
            if($request->isNotFilled('doctor_id') && $request->isNotFilled('speciality_id')){
                $availableAppointments=AvailableAppointmentsResource::collection(Appointment::where([['patient_id','=',1,],['city_id','=',$request->city_id]])->get());
            }elseif ($request->isNotFilled('doctor_id')) {
                $specialitiesArray=Speciality::find($request->speciality_id)->doctors->toArray();
                $doctorsID=array();
                foreach ($specialitiesArray as $key => $value) {
                    array_push($doctorsID,$value['id']);
                }
                $availableAppointments=AvailableAppointmentsResource::collection(Appointment::where([['patient_id','=',1,],['city_id','=',$request->city_id]])->whereIn('doctor_id',$doctorsID)->get());
            }else{
                $availableAppointments=AvailableAppointmentsResource::collection(Appointment::where([['patient_id','=',1,],['city_id','=',$request->city_id],['doctor_id','=',$request->doctor_id]])->get());
                
            }
            return response()->json($availableAppointments,200);
        }  


        return response()->json(['message'=>'Bad request'],401);
    }
}
