<?php

use App\Models\City;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Speciality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackOffice\v1\CityController;
use App\Http\Controllers\BackOffice\v1\PlanController;
use App\Http\Controllers\BackOffice\v1\PatientController;
use App\Http\Controllers\BackOffice\v1\SpecialityController;
use App\Http\Controllers\BackOffice\v1\DoctorController;


Auth::routes();
Route::get('/home', function () {
    return view('pages.main');
});

Route::get('/', function () {
    return view('pages.main');
});

Route::resource('/city',CityController::class);
Route::resource('/speciality',SpecialityController::class);
Route::resource('/plan',PlanController::class);
Route::resource('/doctor',DoctorController::class);
Route::resource('/patient',PatientController::class);
// Route::resource('/appointment',AppointmentController::class);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
