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
        User::factory(1)->create([
            'name' => 'Administrador',
            'email' => 'r@correo.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => 'asg243dfdf',
        ]);
        User::factory(6)->create();
        City::factory(6)->create();
        Speciality::factory(5)->create();
        Plan::factory(5)->create();
        Doctor::factory(6)->create();
        Patient::factory(6)->create();
        Appointment::factory(100)->create();
    }
}
