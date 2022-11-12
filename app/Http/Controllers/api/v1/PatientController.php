<?php

namespace App\Http\Controllers\api\v1;

use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PatientController extends Controller
{
    public function index()
    {
        $patients=Patient::all();
        return response()->json($patients,200);
    }


    public function store(Request $request)
    {
        $patient= new Patient;
        $patient->create($request->all());
        return response()->json($patient->with('plan'),201);
    }

    public function show(Patient $patient)
    {
        $patient=Patient::find($patient->id);
        return response()->json($patient,200);
    }

    public function update(Request $request, Patient $patient)
    {
        $patient=Patient::find($patient->id);
        $patient->update($request->all());
        return response()->json($patient,200);
    }

    public function destroy(Patient $patient,Request $request)
    {
        $patient=Patient::find($patient->id);
        $patient->delete();
        return response()->json(['meessage'=>'Patient was deleted successfully'],204);
    }
}
