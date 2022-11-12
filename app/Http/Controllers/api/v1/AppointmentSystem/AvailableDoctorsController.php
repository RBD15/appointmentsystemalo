<?php

namespace App\Http\Controllers\api\v1\AppointmentSystem;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentSystem\AvailableDoctor;
use App\Http\Resources\AvailableDoctor as ResourcesAvailableDoctor;

class AvailableDoctorsController extends Controller
{
    public function getDoctors(AvailableDoctor $request){
            if($request->isNotFilled('city_id')){
                $doctors=Doctor::find($request->speciality_id)->get();
            }else{
                $doctorsArray=Doctor::find($request->speciality_id)->with('appointments')->get()->toArray();
                $doctors=array();
                foreach ($doctorsArray as $key => $doctor) {
                    foreach ($doctor['appointments'] as $key => $appointment) {
                        if($appointment['patient_id']==1 && $appointment['city_id']==$request->city_id && array_search($doctor['id'],$doctors)===false){
                            array_push($doctors,$doctor['id']);
                        }
                    }
                }
                $doctors=ResourcesAvailableDoctor::collection(Doctor::find($doctors));
            }
        return response()->json($doctors,200);

    }
}
