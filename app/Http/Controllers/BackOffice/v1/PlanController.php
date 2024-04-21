<?php

namespace App\Http\Controllers\BackOffice\v1;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;

class PlanController extends Controller
{

    public function index()
    {
        $token = csrf_token();
        $plans=Plan::all();
        return view('pages.dashboard',['route'=>'/plan','token'=>$token,'values'=>$plans]);
    }


    public function store(Request $request)
    {
        $token = csrf_token();
        $plan= new Plan;
        $plan->name=$request->name;
        $plan->save();
        if($request->has('speciality_id')){
            $plan->specialities()->attach($request->speciality_id);
        }
        $plans=Plan::all();
        return view('pages.dashboard',['route'=>'/plan','token'=>$token,'values'=>$plans]);
    }


    public function create(){
        $token = csrf_token();
        $result=array();
        $plans=Schema::getColumnListing('plans');
        $types=DB::select('describe plans');
        for ($i=0; $i <count($types); $i++) {
            if($types[$i]->Field!="id" && $types[$i]->Field!="created_at" && $types[$i]->Field!="updated_at")
                array_push($result,array("name"=>$plans[$i],"type"=>$this->checkColumnType($types[$i])));
        };
        $fields=json_encode($result,FALSE);
        return view('pages.create',['params'=>json_encode(['csrf'=>$token,'route'=>'/plan'],FALSE),'fields'=>$fields]);
    }

    private function checkColumnType($type){
        $result='text';
        if(str_contains($type->Type,"int"))
            $result='number';

        if(str_contains($type->Type,"varchar"))
            $result='text';

        return $result;
    }

    public function show(Plan $plan)
    {
        $token = csrf_token();
        $plan=Plan::find($plan->id);
        $plans=Plan::all();
        return view('pages.dashboard',['route'=>'/plan','token'=>$token,'values'=>$plans]);
    }

    public function edit(Plan $plan){
        $token = csrf_token();
        $result=array();
        $plans=Schema::getColumnListing('plans');
        $types=DB::select('describe plans');
        for ($i=0; $i <count($types); $i++) {
            if($types[$i]->Field!="id" && $types[$i]->Field!="created_at" && $types[$i]->Field!="updated_at")
                array_push($result,array("name"=>$plans[$i],"type"=>$this->checkColumnType($types[$i])));
        };
        $fields=json_encode($result,FALSE);
        return view('pages.edit',['params'=>json_encode(['csrf'=>$token,'route'=>'/plan'],FALSE),'fields'=>$fields,'model'=>json_encode($plan)]);

    }

    public function update(Request $request, Plan $plan)
    {
        dd('show');
        $plan=Plan::find($plan->id);
        $plan->update($request->all());
        return response()->json($plan,200);
    }

    public function destroy(Plan $plan,Request $request)
    {
        $token = csrf_token();
        $plan=Plan::find($plan->id);
        if($request->has('speciality_id')){
            $plan->specialities()->detach($request->speciality_id);
        }
        $plan->delete();
        $plans=Plan::all();
        return view('pages.dashboard',['route'=>'/plan','token'=>$token,'values'=>$plans]);
    }
}
