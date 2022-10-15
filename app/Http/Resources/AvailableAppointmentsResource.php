<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AvailableAppointmentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request=null)
    {
        return [                
            "id" => $this->id,
            "patient" => $this->patient->only('name','phone_number'),
            "city" => $this->city->only('name','address'),
            "speciality" => $this->doctor->speciality->only(['name','description']),
            "doctor" => $this->doctor->only(['name']),
            "date" => "2022-10-08 17:51:09"
            ];
    }
}