<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\SpecialityController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AppointmentSystem\PatientValidationController;

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

Route::post('/v1/appointment/validate-patient',[PatientValidationController::class,'validationUser']);
