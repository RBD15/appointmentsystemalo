<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SpecialityFactory extends Factory
{
    public function definition()
    {
        $especialidades=['MEDICINA GENERAL','MEDICINA INTERNA','ORTOPEDIA','ODONTOLOGIA'];
        $length=count($especialidades);
        $resultado=$especialidades[$this->faker->numberBetween(0,$length-1)];
        return [
            'name' =>  $resultado,
            'description' =>  $this->faker->paragraph(2)
        ];
    }
}
