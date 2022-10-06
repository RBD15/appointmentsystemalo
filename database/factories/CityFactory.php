<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Nette\Utils\Random;

class CityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $ciudades=['BOGOTA','MEDELLIN','BARRANQUILLA','SANTANDER','CALI'];
        $length=count($ciudades);
        $resultado=$ciudades[$this->faker->numberBetween(0,$length-1)];
        return [
            'name' =>  $resultado,
            'description' => $this->faker->paragraph(2),
            'address'=>$this->faker->address()
        ];
    }
}
