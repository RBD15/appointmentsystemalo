<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Nette\Utils\Random;

class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' =>  $this->faker->name(),
            'age' =>  $this->faker->numberBetween(18,50),
            'address' =>  $this->faker->address(),
            'phone_number' =>  $this->faker->phoneNumber(),
            'plan_id' =>  $this->faker->numberBetween(1,20),
        ];
    }
}
