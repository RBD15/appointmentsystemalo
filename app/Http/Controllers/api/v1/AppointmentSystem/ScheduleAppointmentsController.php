<?php

namespace App\Http\Controllers\api\v1\AppointmentSystem;

use App\Events\SetAppointment;
use App\Models\Patient;
use App\Models\Speciality;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentSystem\Schedule\GetAvailableRequest;
use App\Http\Requests\AppointmentSystem\Schedule\SetAppointmentRequest;
use App\Http\Resources\AvailableAppointmentsResource;
use App\Http\Resources\ScheduledAppointments;
use Carbon\Carbon;

class ScheduleAppointmentsController extends Controller
{

    public function getAvailableAppointments(GetAvailableRequest $request){

        $offset=2;
        $currentDate=date('Y-m-d H:s:i',Carbon::now()->addHours($offset)->getTimestamp());
        if($request->isNotFilled('doctor_id') && $request->isNotFilled('city_id')){
            $specialitiesArray=Speciality::find($request->speciality_id)->doctors->toArray();
            $doctorsID=array();
            foreach ($specialitiesArray as $key => $value) {
                array_push($doctorsID,$value['id']);
            }
            $availableAppointments=AvailableAppointmentsResource::collection(Appointment::whereIn('doctor_id',$doctorsID)->where([['patient_id','=',1,],['date','>',$currentDate]])->get());
        }elseif ($request->isNotFilled('doctor_id')) {
            $specialitiesArray=Speciality::find($request->speciality_id)->doctors->toArray();
            $doctorsID=array();
            foreach ($specialitiesArray as $key => $value) {
                array_push($doctorsID,$value['id']);
            }
            $availableAppointments=AvailableAppointmentsResource::collection(Appointment::whereIn('doctor_id',$doctorsID)->where([['patient_id','=',1,],['city_id','=',$request->city_id],['date','>',$currentDate]])->get());
        }elseif ($request->isNotFilled('city_id')) {
            $availableAppointments=AvailableAppointmentsResource::collection(Appointment::where([['patient_id','=',1,],['doctor_id','=',$request->doctor_id],['date','>',$currentDate]])->get());
        }else{
            $availableAppointments=AvailableAppointmentsResource::collection(Appointment::where([['patient_id','=',1,],['city_id','=',$request->city_id],['doctor_id','=',$request->doctor_id],['date','>',$currentDate]])->get());
        }
        return response()->json($availableAppointments,200);

    }

    public function setAppointments(SetAppointmentRequest $request){

            $patient=Patient::find($request->contrato);
            $appointment=Appointment::find($request->appointment_id);

            if($appointment->patient_id==1){
                $appointment->patient_id=$request->contrato;
                $appointment->save();
                // Event(new SetAppointment($patient,$appointment));
                return response()->json($appointment->only('id','date','city','doctor'),200);
            }
            return response()->json(['message'=>'No es posible agendar la cita seleccionada'],500);
    }

    public function generateAvailableAppointments(Request $request){
        if($request->admin!=1234)
            return response()->json(['message'=>'Unauthorizated'],200);

        $appointments=Appointment::factory(100)->create(['patient_id'=>1]);
        return response()->json($appointments,200);
    }

    public function getPatientAppointments(Request $request){
        $currentDate=date('Y-m-d H:s:i',Carbon::now()->getTimestamp());
        if(Patient::find($request->patient_id)==null)
            return response()->json(["message"=>"Bad request"],500);
        $appointments=ScheduledAppointments::collection(Patient::find($request->patient_id)->appointments()->where([['date','>',$currentDate]])->get());
        return response()->json($appointments,200);
    }

    public function deletePatientAppointments(Request $request){
        $currentDate=date('Y-m-d H:s:i',Carbon::now()->getTimestamp());
        $appointment=Appointment::find($request->appointment_id);
        if($appointment->date>$currentDate){
            if($request->patient_id==$appointment->patient_id && $appointment!=null){
                $appointment->delete();
                return response()->json($appointment,200);
            }
        }
        return response()->json(['message'=>'No es posible cancelar la cita'],500);
    }
}
