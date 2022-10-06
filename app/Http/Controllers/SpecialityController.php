<?php

namespace App\Http\Controllers;

use App\Models\Speciality;
use Illuminate\Http\Request;

class SpecialityController extends Controller
{

    public function index()
    {
        $specialities=Speciality::all();
        return response()->json($specialities,200);
    }


    public function store(Request $request)
    {
        $speciality= new Speciality();
        $speciality->name=$request->name;
        $speciality->description=$request->description;
        $speciality->save();
        if($request->has('plan_id')){
            $speciality->plans()->attach($request->plan_id);
        }
        return response()->json($speciality->with('plans')->get(),201);
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
        $speciality=Speciality::find($speciality->id);
        if($request->has('plan_id')){
            $speciality->plans()->detach($request->plan_id);
        }
        $speciality->delete();
        return response()->json(['meessage'=>'speciality was deleted successfully'],204);
    }
}
