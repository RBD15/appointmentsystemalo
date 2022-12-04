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
                $doctors=Doctor::where('speciality_id',$request->speciality_id)->get();
            }else{
                $doctorsArray=Doctor::where('speciality_id',$request->speciality_id)->with('appointments')->get()->toArray();
                $doctorsID=array();
                foreach ($doctorsArray as $key => $doctor) {
                    foreach ($doctor['appointments'] as $key => $appointment) {
                        if($appointment['patient_id']==1 && $appointment['city_id']==$request->city_id && array_search($doctor['id'],$doctorsID)===false){
                            array_push($doctorsID,$doctor['id']);
                        }
                    }
                }
                $doctors=Doctor::find($doctorsID);
            }
            $doctors=ResourcesAvailableDoctor::collection($doctors);

        return response()->json($doctors,200);

    }
}
