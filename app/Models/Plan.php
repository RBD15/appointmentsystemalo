<?php

namespace App\Models;

use App\Models\Patient;
use App\Models\Speciality;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model
{
    use HasFactory;

    protected $fillable=['name'];

    public function specialities()
    {
        return $this->belongsToMany(Speciality::class);
    }
    
    public function patients()
    {
        return $this->hasMany(Patient::class);
    }
}
