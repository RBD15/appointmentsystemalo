<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{

    public function index()
    {
        $plans=Plan::all();
        return response()->json($plans,200);
    }


    public function store(Request $request)
    {
        $plan= new Plan;
        $plan->name=$request->name;
        $plan->save();
        if($request->has('speciality_id')){
            $plan->specialities()->attach($request->speciality_id);
        }
        return response()->json($plan->with('specialities')->get(),201);
    }

    public function show(Plan $plan)
    {
        $plan=Plan::find($plan->id);
        return response()->json($plan,200);
    }

    public function update(Request $request, Plan $plan)
    {
        $plan=Plan::find($plan->id);
        $plan->update($request->all());
        return response()->json($plan,200);
    }

    public function destroy(Plan $plan,Request $request)
    {
        $plan=Plan::find($plan->id);
        if($request->has('speciality_id')){
            $plan->specialities()->detach($request->speciality_id);
        }
        $plan->delete();
        return response()->json(['meessage'=>'Plan was deleted successfully'],204);
    }
}
