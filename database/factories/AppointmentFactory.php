<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'patient_id' =>  $this->faker->numberBetween(1,5),
            'city_id' =>  $this->faker->numberBetween(1,5),
            'doctor_id' =>  $this->faker->numberBetween(1,5),
            'date'=>date('Y-m-d h:i:s')
        ];
    }
}
