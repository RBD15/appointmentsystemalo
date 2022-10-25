<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SetAppointment
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    public $name;
    public $phoneNumber;
    public $city;
    public $address;
    public $speciality;
    public $doctor;
    public $date;


    public function __construct($patient=null,$appointment=null)
    {
        $this->name=$patient->name;
        $this->phoneNumber=$patient->phone_number;
        $this->city=$appointment->city->name;
        $this->address=$appointment->city->address;
        $this->speciality=$appointment->doctor->speciality->name;
        $this->doctor=$appointment->doctor->name;
        $this->date=$appointment->date;
    }


    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
