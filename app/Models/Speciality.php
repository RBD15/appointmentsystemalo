<?php

namespace App\Models;

use App\Models\Plan;
use App\Models\Doctor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Speciality extends Model
{
    use HasFactory;

    public function plans()
    {
        return $this->belongsToMany(Plan::class);
    }

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class);
    }
}
