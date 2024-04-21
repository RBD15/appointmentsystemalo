<?php

namespace App\Http\Controllers\api\v1\AppointmentSystem;

use App\Models\City;
use App\Models\Speciality;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentSystem\AvailableCities;
use App\Http\Resources\AvailableCity;
use App\Models\AppointmentSystem\AvailableAppointment;

class AvailableCitiesController extends Controller
{
    public function getCities(AvailableCities $request){

            $specialityArray=Speciality::find($request->speciality_id)->doctors->toArray();
            $doctorsID=array();
            foreach ($specialityArray as $key => $value) {
                array_push($doctorsID,$value['id']);
            }

            $currentDate = date('Y-m-d H:i:s');
            $availableAppointmentsaArray=Appointment::whereIn('doctor_id',$doctorsID)->where('patient_id',1)->where('date','>',$currentDate)->get()->pluck('city')->toArray();
            $citiesId=array();
            foreach ($availableAppointmentsaArray as $key => $value) {
                if(array_search($value['id'],$citiesId)===false){
                    array_push($citiesId,$value['id']);
                }
            }
            $cities=AvailableCity::collection(City::find($citiesId));
            return response()->json($cities,200);
    }
}
