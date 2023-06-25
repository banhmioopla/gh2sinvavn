<?php
namespace App\Libraries;

use App\Models\GhApartment;
use App\Models\GhContract;
use App\Models\GhDistrict;
use App\Models\GhRoom;
use CodeIgniter\HTTP\ResponseInterface;

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

    public function dropdownApartmentSelect2($district_code):array{

        $apartments = (new GhApartment())->get(['active' => 'YES', 'district_code' => $district_code]);
        if(empty($apartments)){
            return [
                'items' => ['id' => 0, 'text' => "Dự Án Không Có Phòng"]
            ];
        }

        $items = [];

        foreach ($apartments as $apm){
            if(!in_array($apm->district_code, [4,7,8,'nhabe','binhchanh'])) continue;
            $items[] = [
                'id' => $apm->id,
                'text' => $this->getFullAddress($apm)
            ];
        }

        return ['items' => $items];
    }

    public function dropdownRoomSelect2($apartment_id):array{
        $rooms = (new GhRoom())->get(['apartment_id' => $apartment_id, 'active' => 'YES']);

        if(empty($rooms)){
            return [
                'items' => ['id' => 0, 'text' => "Dự Án Không Có Phòng"]
            ];
        }

        $items = [];

        foreach ($rooms as $item){
            $items[] = [
                'id' => $item->id,
                'text' => empty($item->code) ? ".. không có mã phòng .." : mb_strtoupper($item->code)
            ];
        }

        return ['items' => $items];
    }
}
