<?php

namespace App\Http\Controllers\AppointmentSystem;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AvailableDoctorsController extends Controller
{
    public function getDoctors(Request $request){
        if($request->has('contrato') && $request->has('speciality_id') && $request->has('city_id')){
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
                $doctors=Doctor::find($doctors);
            }
            return response()->json($doctors,200);
        }  
        return response()->json(['message'=>'Bad request'],401); 
    }
}
