<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DoctorFactory extends Factory
{
    public function definition()
    {
        return [
            'name' =>  $this->faker->name(),
            'age' =>  $this->faker->numberBetween(18,50),
            'speciality_id' =>  $this->faker->numberBetween(1,4),
        ];
    }
}
