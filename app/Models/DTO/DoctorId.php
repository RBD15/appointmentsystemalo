<?php

namespace App\Models\DTO;


class DoctorId
{
    private $id;
    function __construct($id)
    {
        $this->id=$id;
    }

    public function getId(){
        return $this->id;
    }

    public function isExist(){
        return $this->id==!null;
    }

}
