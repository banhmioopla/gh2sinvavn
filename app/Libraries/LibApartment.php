<?php
namespace App\Libraries;

use App\Models\GhApartment;
use App\Models\GhContract;
use App\Models\GhDistrict;
use App\Models\GhRoom;

class LibApartment
{
    private GhDistrict $GhDistrict;
    private GhContract $GhContract;
    private GhApartment $GhApartment;
    private GhRoom $GhRoom;

    public function __construct()
    {
        $this->GhDistrict = new GhDistrict();
        $this->GhContract = new GhContract();
        $this->GhApartment = new GhApartment();
        $this->GhRoom = new GhRoom();
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

    public function dropdownApartment():string{
        $list_dropdown = [];
        foreach ($this->getDistrict("code IN (1,4,7,8,10,'binhthanh','govap','binhchanh', 'nhabe')") as $d) {
            $districts[$d->code] =  $d->name;
            $list_apm = $this->GhApartment->get([
                'active' => 'YES',
                'district_code' => $d->code
            ]);

            foreach ($list_apm as $apm){
                $list_dropdown[$apm->id] = $this->getFullAddress($apm);
            }
        }

        return form_dropdown('dropdown_apartment_id' , $list_dropdown, "", ['class' => 'form-control select2']);
    }

    public function dropdownRoom($apm_id):string{
        $list_dropdown = [];
        $list_room = $this->GhRoom->get([
            'active' => 'YES',
            'apartment_id' => $apm_id
        ]);

        foreach ($list_room as $room){
            $list_dropdown[$room->id] = $room->code . ' - ' . number_format($room->price);
        }

        return form_dropdown('dropdown_room_id' , $list_dropdown, "", ['class' => 'form-control']);
    }




}
