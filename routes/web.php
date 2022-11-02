<?php

use App\Models\City;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Speciality;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/speciality', function () {
    $specialities=Speciality::all();
    return view('pages.dashboard',['values'=>$specialities]);
});



Route::get('/city', function () {
    $cities=City::all();
    return view('pages.dashboard',['values'=>$cities]);
});

Route::get('/city/edit/{id}', function (Request $request) {
    $id=$request->id;
    $city=City::find($id);
    dd($city);
    // return view('pages.dashboard',['values'=>$city]);
});

Route::get('/city/delete/{id}', function (Request $request) {
    $id=$request->id;
    $city=City::find($id);
    dd($city);
    // return view('pages.dashboard',['values'=>$city]);
});






Route::get('/doctor', function () {
    $doctors=Doctor::all();
    return view('pages.dashboard',['values'=>$doctors]);
});

Route::get('/patient', function () {
    $patients=Patient::all();
    return view('pages.dashboard',['values'=>$patients]);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
