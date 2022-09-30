<?php

namespace App\Models;

use App\Models\Speciality;
use App\Models\Appointment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Model
{
    use HasFactory;


    public function speciality()
    {
        return $this->hasOne(Speciality::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

}
