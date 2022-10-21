<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Nette\Utils\Random;

class AppointmentFactory extends Factory
{
    public function definition()
    {
        //Patient id=1 is an available Appointment
        return [
            'patient_id' =>  $this->faker->numberBetween(1,3),
            'city_id' =>  $this->faker->numberBetween(1,5),
            'doctor_id' =>  $this->faker->numberBetween(1,5),
            'date'=>$this->generateDate()
        ];
    }

    private function generateDate(){
        $currentDate=Carbon::now();
        $horaAleatoria=$this->faker->numberBetween(7,18);
        $mesAleatoria=$this->faker->numberBetween($currentDate->month,$currentDate->month+1);

        if($mesAleatoria==$currentDate->month){
            $diaAleatoria= $this->generateDay($currentDate,$mesAleatoria,$currentDate->day);
        }else{
            $diaAleatoria= $this->generateDay($currentDate,$mesAleatoria);
        }

        $formato="".$currentDate->year."-".$mesAleatoria."-".$diaAleatoria." ".$horaAleatoria.":00";
        $date= date('Y-m-d H:i:s',strtotime($formato));
        return $date;
    }

    private function generateDay($currentDate,$mesAleatoria,$diaAleatoria=1){
        if($mesAleatoria==2){
            $diaAleatoria=$this->faker->numberBetween($diaAleatoria,28);
        }else{
            $diaAleatoria=$this->faker->numberBetween($diaAleatoria,31);
        }
        return $diaAleatoria;
    }
}
