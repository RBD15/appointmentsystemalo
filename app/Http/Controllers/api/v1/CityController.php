<?php

namespace App\Http\Controllers\api\v1;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
{

    public function index()
    {
        $cities=City::all();
        return response()->json($cities,200);
    }


    public function store(Request $request)
    {
        $city = new City;
        $city->create($request->all());
        return response()->json($city,201);
    }

    public function show(City $city)
    {
        $city=City::find($city->id);
        return response()->json($city,200);
    }

    public function update(Request $request, City $city)
    {
        $city=City::find($city->id);
        $city->update($request->all());
        return response()->json($city,200);
    }

    public function destroy(City $city)
    {
        $city=City::find($city->id);
        $city->delete();
        return response()->json(['meessage'=>'City was deleted successfully'],204);
    }
}
