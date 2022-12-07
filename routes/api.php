<?php

use App\Http\Controllers\api\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\CityController;
use App\Http\Controllers\api\v1\PlanController;
use App\Http\Controllers\api\v1\DoctorController;
use App\Http\Controllers\api\v1\PatientController;
use App\Http\Controllers\api\v1\SpecialityController;
use App\Http\Controllers\api\v1\AppointmentController;
use App\Http\Controllers\api\v1\AppointmentSystem\PatientValidationController;
use App\Http\Controllers\api\v1\AppointmentSystem\AvailableCitiesController;
use App\Http\Controllers\api\v1\AppointmentSystem\AvailableDoctorsController;
use App\Http\Controllers\api\v1\AppointmentSystem\AvailableSpecialiesController;
use App\Http\Controllers\api\v1\AppointmentSystem\ScheduleAppointmentsController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//V1
Route::apiResource('/v1/city',CityController::class)->names([
    "index"=>"city_api.index",
    "store"=>"city_api.store",
    "show"=>"city_api.show",
    "update"=>"city_api.update",
    "destroy"=>"city_api.destroy"
]);
Route::apiResource('/v1/speciality',SpecialityController::class)->names([
    "index"=>"speciality_api.index",
    "store"=>"speciality_api.store",
    "show"=>"speciality_api.show",
    "update"=>"speciality_api.update",
    "destroy"=>"speciality_api.destroy" 
]);
Route::apiResource('/v1/plan',PlanController::class)->names([
    "index"=>"plan_api.index",
    "store"=>"plan_api.store",
    "show"=>"plan_api.show",
    "update"=>"plan_api.update",
    "destroy"=>"plan_api.destroy"
]);
Route::apiResource('/v1/doctor',DoctorController::class)->names([
    "index"=>"doctor_api.index",
    "store"=>"doctor_api.store",
    "show"=>"doctor_api.show",
    "update"=>"doctor_api.update",
    "destroy"=>"doctor_api.destroy" 
]);
Route::apiResource('/v1/patient',PatientController::class)->names([
    "index"=>"patient_api.index",
    "store"=>"patient_api.store",
    "show"=>"patient_api.show",
    "update"=>"patient_api.update",
    "destroy"=>"patient_api.destroy" 
]);
Route::apiResource('/v1/appointment',AppointmentController::class)->names([
    "index"=>"appointment_api.index",
    "store"=>"appointment_api.store",
    "show"=>"appointment_api.show",
    "update"=>"appointment_api.update",
    "destroy"=>"appointment_api.destroy"
]);


Route::post('/v1/appointment-system/validate-patient',[PatientValidationController::class,'validationUser']);
Route::post('/v1/appointment-system/generate-available-appointments',[ScheduleAppointmentsController::class,'generateAvailableAppointments']);
Route::post('/v1/appointment-system/get-available-appointments',[ScheduleAppointmentsController::class,'getAvailableAppointments']);
Route::post('/v1/appointment-system/set-appointment',[ScheduleAppointmentsController::class,'setAppointments']);
Route::post('/v1/appointment-system/get-patient-appointments',[ScheduleAppointmentsController::class,'getPatientAppointments']);
Route::post('/v1/appointment-system/delete-patient-appointments',[ScheduleAppointmentsController::class,'deletePatientAppointments']);
Route::post('/v1/appointment-system/get-available-speciality',[AvailableSpecialiesController::class,'getSpecialities']);
Route::post('/v1/appointment-system/get-available-city',[AvailableCitiesController::class,'getCities']);
Route::post('/v1/appointment-system/get-available-doctor',[AvailableDoctorsController::class,'getDoctors']);

Route::post('authenticate',[LoginController::class,'login']);
Route::post('/v2/appointment-system/get-available-speciality',[AvailableSpecialiesController::class,'getSpecialities'])->middleware('auth:sanctum');