<?php

namespace App\Http\Controllers\v1;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;

class PatientController extends Controller
{
    public function index()
    {
        $token = csrf_token();
        $patients=Patient::all();
        return view('pages.dashboard',['route'=>'/patient','token'=>$token,'values'=>$patients]);
    }


    public function store(Request $request)
    {
        $token = csrf_token();
        $patient= new Patient;
        $patient->create($request->all());
        $patients=Patient::all();
        return view('pages.dashboard',['route'=>'/patient','token'=>$token,'values'=>$patients]);
    }

    public function create(){
        $token = csrf_token();
        $result=array();
        $patients=Schema::getColumnListing('patients');
        $types=DB::select('describe patients');
        for ($i=0; $i <count($types); $i++) { 
            if($types[$i]->Field!="id" && $types[$i]->Field!="created_at" && $types[$i]->Field!="updated_at")
                array_push($result,array("name"=>$patients[$i],"type"=>$this->checkColumnType($types[$i])));
        };
        $fields=json_encode($result,FALSE);
        return view('pages.create',['params'=>json_encode(['csrf'=>$token,'route'=>'/patient'],FALSE),'fields'=>$fields]);
    }

    private function checkColumnType($type){
        $result='text';
        if(str_contains($type->Type,"int"))
            $result='number';

        if(str_contains($type->Type,"varchar"))
            $result='text';

        return $result;
    }

    public function show(Patient $patient)
    {
        dd($patient);
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
        $token = csrf_token();
        $patient=Patient::find($patient->id);
        $patient->delete();
        $patients=Patient::all();
        return view('pages.dashboard',['route'=>'/doctor','token'=>$token,'values'=>$patients]);
    }
}
