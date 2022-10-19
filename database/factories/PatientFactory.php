<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    public function definition()
    {
        return [
            'name' =>  $this->faker->name(),
            'document' =>  $this->faker->numberBetween(1,99999999),
            'age' =>  $this->faker->numberBetween(18,50),
            'address' =>  $this->faker->address(),
            'phone_number' =>  $this->faker->numberBetween(18,50),
            'plan_id' =>  $this->faker->numberBetween(1,4),
            'status'=>'active'
        ];
    }
}
