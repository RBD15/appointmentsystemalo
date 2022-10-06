<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments=Appointment::all();
        return response()->json($appointments,200);
    }


    public function store(Request $request)
    {
        $appointment= new Appointment();
        $appointment->create($request->all());
        return response()->json($appointment,201);
    }

    public function show(Appointment $appointment)
    {
        $appointment=Appointment::find($appointment->id);
        return response()->json($appointment,200);
    }

    public function update(Request $request, Appointment $appointment)
    {
        $appointment=Appointment::find($appointment->id);
        $appointment->update($request->all());
        return response()->json($appointment,200);
    }

    public function destroy(Appointment $appointment,Request $request)
    {
        $appointment=Appointment::find($appointment->id);
        if($request->has('plan_id')){
            $appointment->plans()->detach($request->plan_id);
        }
        $appointment->delete();
        return response()->json(['meessage'=>'Appointment was deleted successfully'],204);
    }

}
