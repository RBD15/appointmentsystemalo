<?php

namespace App\Http\Controllers\AppointmentSystem;

use App\Models\Patient;
use App\Models\Speciality;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AvailableAppointmentsResource;
use Carbon\Carbon;

class ScheduleAppointmentsController extends Controller
{

    public function getAvailableAppointments(Request $request){
        if($request->has('doctor_id') && $request->has('speciality_id') && $request->has('city_id')){
            $offset='+2 Hours';
            $currentDate=date('Y-m-d H:s:i',Carbon::now($offset)->getTimestamp());
            if($request->isNotFilled('doctor_id') && $request->isNotFilled('speciality_id')){
                $availableAppointments=AvailableAppointmentsResource::collection(Appointment::where([['patient_id','=',1,],['city_id','=',$request->city_id],['date','>',$currentDate]])->get());
            }elseif ($request->isNotFilled('doctor_id')) {
                $specialitiesArray=Speciality::find($request->speciality_id)->doctors->toArray();
                $doctorsID=array();
                foreach ($specialitiesArray as $key => $value) {
                    array_push($doctorsID,$value['id']);
                }
                $availableAppointments=AvailableAppointmentsResource::collection(Appointment::whereIn('doctor_id',$doctorsID)->where([['patient_id','=',1,],['city_id','=',$request->city_id],['date','>',$currentDate]])->get());
            }else{
                $availableAppointments=AvailableAppointmentsResource::collection(Appointment::where([['patient_id','=',1,],['city_id','=',$request->city_id],['doctor_id','=',$request->doctor_id],['date','>',$currentDate]])->get());
            }
            return response()->json($availableAppointments,200);
        }  
        return response()->json(['message'=>'Bad request'],401);
    }

    public function setAppointments(Request $request){

        if($request->has('contrato') && $request->has('appointment_id')){
            $patient=Patient::find($request->contrato);
            $appointment=Appointment::find($request->appointment_id);

            $appointment->patient_id=$request->contrato;
            $appointment->save();

            return response()->json($appointment,200);
        }  
        return response()->json(['message'=>'Bad request'],401);
    }

    public function generateAvailableAppointments(Request $request){
        if($request->admin!=1234)
            return response()->json(['message'=>'Unauthorizated'],200);

        $appointments=Appointment::factory(100)->create(['patient_id'=>1]);
        return response()->json($appointments,200);
    }
}
