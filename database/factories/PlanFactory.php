<?php

namespace Database\Factories;

use Nette\Utils\Random;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $planes=['Basico','Individual','Familiar','Premium'];
        $length=count($planes);
        return [
            'name' =>  $planes[$this->faker->numberBetween(0,$length-1)],
        ];
    }
}
