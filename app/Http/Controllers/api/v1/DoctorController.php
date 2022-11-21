<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors=Doctor::all();
        return response()->json($doctors,200);
    }


    public function store(Request $request)
    {
        $doctor= new Doctor;
        $doctor->create($request->all());
        return response()->json($doctor->with('speciality'),201);
    }

    public function show(Doctor $doctor)
    {
        $doctor=Doctor::find($doctor->id);
        return response()->json($doctor,200);
    }

    public function update(Request $request, Doctor $doctor)
    {
        $doctor=Doctor::find($doctor->id);
        $doctor->update($request->all());
        return response()->json($doctor,200);
    }

    public function destroy(Doctor $doctor,Request $request)
    {
        $doctor=Doctor::find($doctor->id);
        $doctor->delete();
        return response()->json(['meessage'=>'Doctor was deleted successfully'],204);
    }
}
