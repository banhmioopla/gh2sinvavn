<?php
namespace App\Libraries;

use App\Models\GhDistrict;

class LibApartment
{
    private GhDistrict $GhDistrict;

    public function __construct()
    {
        $this->GhDistrict = new GhDistrict();
    }

    public function getDistrict($where = []):array{
        return $this->GhDistrict->get($where);
    }

    public function getFullAddress($apartment_object){
        if(!empty($apartment_object)){
            return mb_strtoupper($apartment_object->address_street . ', Phường '.$apartment_object->address_ward );
        }
        return "";
    }




}
