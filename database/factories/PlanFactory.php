<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PlanFactory extends Factory
{
    public function definition()
    {
        $planes=['Basico','Individual','Familiar','Premium'];
        $length=count($planes);
        $resultado=$planes[$this->faker->numberBetween(0,$length-1)];
        return [
            'name' =>  $resultado,
        ];
    }
}
