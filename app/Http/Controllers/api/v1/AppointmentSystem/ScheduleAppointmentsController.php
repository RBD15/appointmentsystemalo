<?php

namespace App\Http\Controllers\api\v1\AppointmentSystem;

use App\Events\SetAppointment;
use App\Models\Patient;
use App\Models\Speciality;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentSystem\Schedule\DeletePatientAppointmentsRequest;
use App\Http\Requests\AppointmentSystem\Schedule\GetAvailableRequest;
use App\Http\Requests\AppointmentSystem\Schedule\GetPatientAppointmentsRequest;
use App\Http\Requests\AppointmentSystem\Schedule\SetAppointmentRequest;
use App\Models\AppointmentSystem\AvailableAppointment;
use App\Models\AppointmentSystem\ScheduledAppointments;
use Carbon\Carbon;

class ScheduleAppointmentsController extends Controller
{

    public function getAvailableAppointments(GetAvailableRequest $request){

        $offset=2;
        $currentDate=date('Y-m-d H:s:i',Carbon::now()->addHours($offset)->getTimestamp());
        $availableAppointment = new AvailableAppointment($request->city_id,$request->speciality_id,$request->doctor_id);

        $availableAppointments=$availableAppointment->getAppointments($currentDate);
        return response()->json($availableAppointments,200);

    }

    public function setAppointments(SetAppointmentRequest $request){
        $availableAppointment = new AvailableAppointment();
        $result = $availableAppointment->setAppointment($request->contrato,$request->appointment_id);
        if($result!==false)
            return response()->json($result,200);

        return response()->json(['message'=>'No es posible agendar la cita seleccionada'],500);
    }

    public function generateAvailableAppointments(Request $request){
        if($request->admin!=1234)
            return response()->json(['message'=>'Unauthorizated'],200);

        $availableAppointment = new AvailableAppointment();
        $appointments=$availableAppointment->generateAvailableAppointments();
        return response()->json($appointments,200);
    }

    public function getPatientAppointments(GetPatientAppointmentsRequest $request){
        $currentDate=date('Y-m-d H:s:i',Carbon::now()->getTimestamp());
        $scheduledAppointment = new ScheduledAppointments();
        $appointments = $scheduledAppointment->getPatientAppointments($request->patient_id,$currentDate);
        return response()->json($appointments,200);
    }

    public function deletePatientAppointments(DeletePatientAppointmentsRequest $request){
        $currentDate=date('Y-m-d H:s:i',Carbon::now()->getTimestamp());
        $scheduledAppointment = new ScheduledAppointments();
        $result = $scheduledAppointment->deletePatientAppointment($request->appointment_id,$request->patient_id,$currentDate);
        if($result!==false)
            return response()->json($result,200);

        return response()->json(['message'=>'No es posible cancelar la cita'],500);
    }
}
