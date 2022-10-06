<?php

namespace App\Models;

use App\Models\Plan;
use App\Models\Doctor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Speciality extends Model
{
    use HasFactory;

    protected $fillable = ['name','description'];

    public function plans()
    {
        return $this->belongsToMany(Plan::class);
    }


    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }
}
