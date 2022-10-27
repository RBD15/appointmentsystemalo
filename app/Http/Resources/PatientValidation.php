<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientValidation extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'contrato'=>$this->id,
            'name'=>$this->name,
            'age'=>$this->age,
            'address'=>$this->address,
            'phone_number'=>$this->phone_number,
            'plan'=>$this->plan_id,
            'status'=>$this->status
        ];
    }
}
