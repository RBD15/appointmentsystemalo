<?php

namespace App\Http\Controllers\v1;

use App\Models\Speciality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;

class SpecialityController extends Controller
{
    public function index()
    {
        $token = csrf_token();
        $specialities=Speciality::all();
        return view('pages.dashboard',['route'=>'/speciality','token'=>$token,'values'=>$specialities]);
    }

    public function create(){
        $token = csrf_token();
        $result=array();
        $specialities=Schema::getColumnListing('specialities');
        $types=DB::select('describe specialities');
        for ($i=0; $i <count($types); $i++) { 
            if($types[$i]->Field!="id" && $types[$i]->Field!="created_at" && $types[$i]->Field!="updated_at")
                array_push($result,array("name"=>$specialities[$i],"type"=>$this->checkColumnType($types[$i])));
        };
        $fields=json_encode($result,FALSE);
        return view('pages.create',['params'=>json_encode(['csrf'=>$token,'route'=>'/speciality'],FALSE),'fields'=>$fields]);
    }

    private function checkColumnType($type){
        $result='text';
        if(str_contains($type->Type,"int"))
            $result='number';

        if(str_contains($type->Type,"varchar"))
            $result='text';

        return $result;
    }

    public function store(Request $request)
    {
        $token = csrf_token();
        $speciality= new Speciality();
        $speciality->name=$request->name;
        $speciality->description=$request->description;
        $speciality->save();
        if($request->has('plan_id')){
            $speciality->plans()->attach($request->plan_id);
        }
        $specialities=Speciality::all();
        return view('pages.dashboard',['route'=>'/speciality','token'=>$token,'values'=>$specialities]);
    }

    public function show(Speciality $speciality)
    {
        $speciality=Speciality::find($speciality->id);
        return response()->json($speciality,200);
    }

    public function update(Request $request, Speciality $speciality)
    {
        $speciality=Speciality::find($speciality->id);
        $speciality->update($request->all());
        return response()->json($speciality,200);
    }

    public function destroy(Speciality $speciality,Request $request)
    {
        $token = csrf_token();
        $speciality=Speciality::find($speciality->id);
        if($request->has('plan_id')){
            $speciality->plans()->detach($request->plan_id);
        }
        $speciality->delete();
        $specialities=Speciality::all();
        return view('pages.dashboard',['route'=>'/speciality','token'=>$token,'values'=>$specialities]);
    }
}
