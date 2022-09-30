<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Plan;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Speciality;
use App\Models\Appointment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::factory(10)->create();
        City::factory(10)->create();        
        Doctor::factory(10)->create();       
        Plan::factory(10)->create();
        Speciality::factory(10)->create();
        Patient::factory(10)->create();
        Appointment::factory(10)->create();
    }
}
