<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AvailableAppointmentsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        dd($this->collection);
        return [                
            "id" => $this->id,
            "patient" => "Lillian Schimmel DDS",
            "city" => "43",
            "speciality" => "2",
            "doctor" => '22',
            "date" => "2022-10-08 17:51:09"
            ];
    }
}
