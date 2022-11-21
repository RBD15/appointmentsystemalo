<?php

namespace App\Http\Controllers\v1;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;

class CityController extends Controller
{
    public function index()
    {
        $cities=City::all();
        $token = csrf_token();
        return view('pages.dashboard',['route'=>'/city','token'=>$token,'values'=>$cities]);
    }


    public function create(){
        $token = csrf_token();
        $cityModel=new City();
        $result=array();
        $cities=Schema::getColumnListing('cities');
        $types=DB::select('describe cities');
        for ($i=0; $i <count($types); $i++) { 
            if($types[$i]->Field!="id" && $types[$i]->Field!="created_at" && $types[$i]->Field!="updated_at")
                array_push($result,array("name"=>$cities[$i],"type"=>$this->checkColumnType($types[$i])));
        };
        $fields=json_encode($result,FALSE);
        return view('pages.create',['params'=>json_encode(['csrf'=>$token,'route'=>'/city'],FALSE),'fields'=>$fields,'action'=>'create']);
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
        $city = new City;
        $city->create($request->all());
        $cities=City::all();
        return view('pages.dashboard',['route'=>'/city','token'=>$token,'values'=>$cities]);
    }

    public function show(City $city)
    {           
        $token = csrf_token();
        dd('show');
        $city=City::find($city->id);
        $cities=City::all();
        return view('pages.dashboard',['route'=>'/city','token'=>$token,'values'=>$cities]);
    }

    public function edit(City $city){
        // dd($city);
        $token = csrf_token();
        $result=array();
        $cities=Schema::getColumnListing('cities');
        $types=DB::select('describe cities');
        for ($i=0; $i <count($types); $i++) { 
            if($types[$i]->Field!="id" && $types[$i]->Field!="created_at" && $types[$i]->Field!="updated_at")
                array_push($result,array("name"=>$cities[$i],"type"=>$this->checkColumnType($types[$i])));
        };
        $fields=json_encode($result,FALSE);
        return view('pages.edit',['params'=>json_encode(['csrf'=>$token,'route'=>'/city'],FALSE),'fields'=>$fields,'model'=>json_encode($city)]);

    }

    public function update(Request $request, City $city)
    {   dd($city);
        $city=City::find($city->id);
        $city->update($request->all());
        return response()->json($city,200);
    }

    public function destroy(City $city)
    {           
        $token = csrf_token();
        $city=City::find($city->id);
        $city->delete();
        $cities=City::all();
        return view('pages.dashboard',['route'=>'/city','token'=>$token,'values'=>$cities]);
    }
}
