<?php

namespace App\Models\AppointmentSystem;

use App\Models\Patient;
use App\Models\DTO\CityId;
use App\Models\Speciality;
use App\Models\Appointment;
use App\Models\DTO\DoctorId;
use App\Models\DTO\SpecialityId;
use App\Http\Resources\AvailableAppointmentsResource;

class AvailableAppointment{

    private $cityId;
    private $specialityId;
    private $doctorId;

    public function __construct($city_id=null,$speciality_id=null,$doctor_id=null)
    {
        $this->cityId=new CityId($city_id);
        $this->specialityId=new SpecialityId($speciality_id);
        $this->doctorId=new DoctorId($doctor_id);
    }

    public function getAppointments($currentDate){
        if(!$this->doctorId->isExist() && !$this->cityId->isExist()){
            $specialitiesArray=Speciality::find($this->specialityId->getId())->doctors->toArray();
            $doctorsID=array();
            foreach ($specialitiesArray as $key => $value) {
                array_push($doctorsID,$value['id']);
            }
            $availableAppointments=AvailableAppointmentsResource::collection(Appointment::whereIn('doctor_id',$doctorsID)->where([['patient_id','=',1,],['date','>',$currentDate]])->get());
            return $availableAppointments;
        }

        if (!$this->doctorId->isExist()) {
            $specialitiesArray=Speciality::find($this->specialityId->getId())->doctors->toArray();
            $doctorsID=array();
            foreach ($specialitiesArray as $key => $value) {
                array_push($doctorsID,$value['id']);
            }
            $availableAppointments=AvailableAppointmentsResource::collection(Appointment::whereIn('doctor_id',$doctorsID)->where([['patient_id','=',1,],['city_id','=',$this->cityId->getId()],['date','>',$currentDate]])->get());
            return $availableAppointments;
        }

        if (!$this->cityId->isExist()) {
            $availableAppointments=AvailableAppointmentsResource::collection(Appointment::where([['patient_id','=',1,],['doctor_id','=',$this->doctorId->getId()],['date','>',$currentDate]])->get());
            return $availableAppointments;
        }

        $availableAppointments=AvailableAppointmentsResource::collection(Appointment::where([['patient_id','=',1,],['city_id','=',$this->cityId->getId()],['doctor_id','=',$this->doctorId->getId()],['date','>',$currentDate]])->get());
        return $availableAppointments;
    }

    public function generateAvailableAppointments(){
        return Appointment::factory(100)->create(['patient_id'=>1]);
    }

    public function setAppointment($contrato,$appointmentId){
        $patient=Patient::find($contrato);
        $appointment=Appointment::find($appointmentId);

        if($appointment->patient_id==1){
            $appointment->patient_id=$contrato;
            $appointment->save();
            // Event(new SetAppointment($patient,$appointment));
            return $appointment->only('id','date','city','doctor');
        }
        return false;
    }
}

?>
