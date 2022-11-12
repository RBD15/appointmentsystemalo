<?php

use App\Models\City;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Speciality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v1\CityController;
use App\Http\Controllers\v1\PlanController;
use App\Http\Controllers\v1\DoctorController;
use App\Http\Controllers\v1\PatientController;
use App\Http\Controllers\v1\SpecialityController;


Route::get('/', function () {
    return view('welcome');
});

Route::resource('/city',CityController::class);
Route::resource('/speciality',SpecialityController::class);
Route::resource('/plan',PlanController::class);
Route::resource('/doctor',DoctorController::class);
Route::resource('/patient',PatientController::class);
// Route::resource('/appointment',AppointmentController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
