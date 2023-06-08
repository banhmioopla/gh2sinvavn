<?php
namespace App\Libraries;

use App\Models\GhContract;
use App\Models\GhDistrict;

class LibApartment
{
    private GhDistrict $GhDistrict;
    private GhContract $GhContract;

    public function __construct()
    {
        $this->GhDistrict = new GhDistrict();
        $this->GhContract = new GhContract();
    }

    public function getDistrict($where = []):array{
        return $this->GhDistrict->get($where);
    }

    public function getFullAddress($apartment_object):string{
        if(!empty($apartment_object)){
            return mb_strtoupper($apartment_object->address_street . ', Phường '.$apartment_object->address_ward );
        }
        return "";
    }

    public function getLastContractInLeaseTerm($room_id){
        return $this->GhContract->getFirst([
            'room_id' => $room_id,
            'time_expire > ' => time()
        ]);
    }




}
