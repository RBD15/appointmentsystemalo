<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SetAppointmentListener
{

    private $message;
    private $searchParams;

    public function __construct()
    {
        $this->searchParams=['{especialidad}','{fecha}','{doctor}','{ciudad}','{direccion}'];
        $this->message="Estimado usuario su cita de {especialidad} para el dia {fecha} con el doctor {doctor} en la ciudad {ciudad}, con direccion {direccion} ha sido agendad correctamente";
    }

    public function handle($event)
     {   
        $values=[$event->speciality,$event->date,$event->doctor,$event->city,$event->address];
        $message=str_replace($this->searchParams,$values,$this->message);
        $this->send(env('TEST_NUMBER'),$message);

    }

    private function send($phoneNumber,$message){
        $curl = curl_init();

        $body = json_encode(
            [
             'connector_id' => "1078",
             'telephone' => $phoneNumber,
             "message"=>$message,
             "url_attach"=>""
            ]);
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://wv0000.wolkvox.com/api/v2/whatsapp.php?api=send_message_mobil',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>$body,
        CURLOPT_HTTPHEADER => array(
            'wolkvox-token: 7b69645f6469737472697d2d3230323231303234313234303532',
            'Content-Type: application/json'
        ),
        CURLOPT_SSL_VERIFYHOST=>0,
        CURLOPT_SSL_VERIFYPEER=>0
        ));

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        // echo $response;

    }
}
