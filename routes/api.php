<?php

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

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/v1/city',CityController::class);
Route::apiResource('/v1/speciality',SpecialityController::class);
Route::apiResource('/v1/plan',PlanController::class);
Route::apiResource('/v1/doctor',DoctorController::class);
Route::apiResource('/v1/patient',PatientController::class);
Route::apiResource('/v1/appointment',AppointmentController::class);

Route::post('/v1/appointment-system/validate-patient',[PatientValidationController::class,'validationUser']);
Route::post('/v1/appointment-system/generate-available-appointments',[ScheduleAppointmentsController::class,'generateAvailableAppointments']);
Route::post('/v1/appointment-system/get-available-appointments',[ScheduleAppointmentsController::class,'getAvailableAppointments']);
Route::post('/v1/appointment-system/set-appointment',[ScheduleAppointmentsController::class,'setAppointments']);
Route::post('/v1/appointment-system/get-patient-appointments',[ScheduleAppointmentsController::class,'getPatientAppointments']);
Route::post('/v1/appointment-system/delete-patient-appointments',[ScheduleAppointmentsController::class,'deletePatientAppointments']);
Route::post('/v1/appointment-system/get-available-speciality',[AvailableSpecialiesController::class,'getSpecialities']);
Route::post('/v1/appointment-system/get-available-city',[AvailableCitiesController::class,'getCities']);
Route::post('/v1/appointment-system/get-available-doctor',[AvailableDoctorsController::class,'getDoctors']);

