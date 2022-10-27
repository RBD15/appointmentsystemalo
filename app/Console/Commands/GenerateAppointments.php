<?php

namespace App\Console\Commands;

use App\Models\Appointment;
use Illuminate\Console\Command;

class GenerateAppointments extends Command
{
    protected $signature = 'command:generate-appointments';

    protected $description = 'Use to create a new group of appointments using Appointment Factory';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        Appointment::factory(1)->create(['patient_id'=>1]);
        echo "[DONE] New a hundred appointments were created";
    }
}
