<?php

namespace App\Models\AppointmentSystem;

use App\Models\Patient;
use App\Models\Appointment;
use App\Http\Resources\ScheduledAppointments as Scheduled;

class ScheduledAppointments{

    public function getPatientAppointments($patientId,$currentDate){
        $appointments=Scheduled::collection(Patient::find($patientId)->appointments()->where([['date','>',$currentDate]])->get());
        return $appointments;
    }

    public function deletePatientAppointment($appointmentId,$patientId,$currentDate){
        $appointment=Appointment::find($appointmentId);
        if($appointment->date>$currentDate){
            if($patientId==$appointment->patient_id && $appointment!=null){
                $appointment->update(['patient_id'=>1]);
                return $appointment->only('id','date');
            }
        }
        return false;
    }

}

?>
