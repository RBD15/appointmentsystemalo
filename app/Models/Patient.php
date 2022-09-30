<?php

namespace App\Models;

use App\Models\Plan;
use App\Models\Appointment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
