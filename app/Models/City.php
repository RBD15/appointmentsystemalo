<?php

namespace App\Models;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;

    protected $fillable=['name','description','address'];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    // public function toArray()
    // {
    //     return [
    //         "name"=>$this->name,
    //         "description"=>$this->description,
    //         "address"=>$this->address
    //     ];
    // }
}
