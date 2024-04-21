<?php

namespace App\Http\Controllers\BackOffice\v1;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;

class DoctorController extends Controller
{
    public function index()
    {
        $token = csrf_token();
        $doctors=Doctor::all();
        return view('pages.dashboard',['route'=>'/doctor','token'=>$token,'values'=>$doctors]);
    }


    public function store(Request $request)
    {
        $token = csrf_token();
        $doctor= new Doctor;
        $doctor->create($request->all());
        $doctor=Doctor::all();
        return view('pages.dashboard',['route'=>'/doctor','token'=>$token,'values'=>$doctor]);
    }

    public function create(){
        $token = csrf_token();
        $result=array();
        $doctors=Schema::getColumnListing('doctors');
        $types=DB::select('describe doctors');
        for ($i=0; $i <count($types); $i++) {
            if($types[$i]->Field!="id" && $types[$i]->Field!="created_at" && $types[$i]->Field!="updated_at")
                array_push($result,array("name"=>$doctors[$i],"type"=>$this->checkColumnType($types[$i])));
        };
        $fields=json_encode($result,FALSE);
        return view('pages.create',['params'=>json_encode(['csrf'=>$token,'route'=>'/doctor'],FALSE),'fields'=>$fields]);
    }

    private function checkColumnType($type){
        $result='text';
        if(str_contains($type->Type,"int"))
            $result='number';

        if(str_contains($type->Type,"varchar"))
            $result='text';

        return $result;
    }

    public function show(Doctor $doctor)
    {
        dd($doctor);
        $doctor=Doctor::find($doctor->id);
        return response()->json($doctor,200);
    }

    public function edit(Doctor $doctor){
        $token = csrf_token();
        $result=array();
        $doctors=Schema::getColumnListing('doctors');
        $types=DB::select('describe doctors');
        for ($i=0; $i <count($types); $i++) {
            if($types[$i]->Field!="id" && $types[$i]->Field!="created_at" && $types[$i]->Field!="updated_at")
                array_push($result,array("name"=>$doctors[$i],"type"=>$this->checkColumnType($types[$i])));
        };
        $fields=json_encode($result,FALSE);
        return view('pages.edit',['params'=>json_encode(['csrf'=>$token,'route'=>'/doctor'],FALSE),'fields'=>$fields,'model'=>json_encode($doctor)]);

    }

    public function update(Request $request, Doctor $doctor)
    {
        $doctor=Doctor::find($doctor->id);
        $doctor->update($request->all());
        return response()->json($doctor,200);
    }

    public function destroy(Doctor $doctor,Request $request)
    {
        $token = csrf_token();
        $doctor=Doctor::find($doctor->id);
        $doctor->delete();
        $doctors=Doctor::all();
        return view('pages.dashboard',['route'=>'/doctor','token'=>$token,'values'=>$doctors]);
    }
}
