<?php
namespace Modules\Apartment\Controllers;

use App\Libraries\LibApartment;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Modules\Layouts\Controllers\BaseController;
use Psr\Log\LoggerInterface;
use ZipArchive;

class Apartment extends BaseController
{
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger); // TODO: Change the autogenerated stub
    }


    public function sightseeing()
    {

        $districts = [0 => 'Chọn quận'];

        foreach ($this->LibApartment->getDistrict("code IN (1,4,7,8,10,'binhthanh','govap','binhchanh', 'nhabe')") as $d) {
            $districts[$d->code] =  $d->name;
        }

        $dropdown_district = form_dropdown("dropdown-district",$districts,"",  [
            'class' => 'form-control select2',
            'id' => 'dropdown-district'
        ]);

        return view('\Modules\Apartment\Views\apartment\sightseeing',[
            'dropdown_district' => $dropdown_district,
            'breadcrumb' => 'Thông tin phòng',
        ]);
    }

    public function searchingRoom():ResponseInterface{
        $district_code = $this->request->getGet('district_code');
        $apartment_id = $this->request->getGet('apartment_id');

        $params = "active = 'YES'";
        $list_room = [];
        $searching_title = ''; $cards = '';

        if(!empty($this->request->getGet('price_min'))){
            $price_min = $this->request->getGet('price_min');
            $params .= " AND price >= {$price_min} ";

        }

        if(!empty($this->request->getGet('price_max'))){
            $price_max = $this->request->getGet('price_max');
            $params .= " AND price <= {$price_max} ";
        }


        if(empty($district_code)){
            return $this->response->setJSON([
                'status' => false,
                'msg' => 'Vui lòng chọn quận',
            ]);
        }

        if(empty($apartment_id)){
            $list_apartment = $this->GhApartment->get([
                'district_code' => $district_code,
                'active' => 'YES'
            ]);
            $apartment_ids = [];
            foreach ($list_apartment as $item){
                $apartment_ids[] = $item->id;
            }
            $list_room = $this->GhRoom->get("active = 'YES' AND apartment_id IN (".implode(',', $apartment_ids).")", "apartment_id ASC, price DESC");

        }

        if(!empty($apartment_id)){
            $params .= " AND apartment_id = {$apartment_id}";
            $list_room = $this->GhRoom->get($params, 'price DESC');
            $address = $this->GhApartment->getFirstById($apartment_id)?->address_street;
            $searching_title .= "<span class='badge rounded-pill bg-label-dark mx-1 my-1'>{$address}</span>";
        }

         $room_count = count($list_room);
        $search_apm_ids = [];
        foreach ($list_room as $room) {
            $apm = $this->GhApartment->getFirstById($room->apartment_id);

            $card_text = "<div class='fw-bold d-flex justify-content-between'>". ($room->price ? "<i class='ti ti-tag'></i>" . number_format($room->price) : "chưa cập nhật") . "</div>";
            $card_text .= '<div class="d-flex justify-content-between mt-1"><span> <i class="ti ti-cash"></i> HH 06 tháng</span> <strong>'  . $apm?->commission_rate_6m .   '%</strong></div>';
            $card_text .= '<div class="d-flex justify-content-between mt-1"><span> <i class="ti ti-cash"></i> HH 12 tháng</span> <strong>'  . $apm?->commission_rate .   '%</strong></div>';

            $cards .= '<div class="col-xl-3 mb-3">'. view('\Modules\Apartment\Views\apartment\card-room.php',[
                'title' => mb_strtoupper($room->code),
                'subtitle' => $apm?->address_street . ' , phường ' . $apm?->address_ward,
                'card_text' => $card_text,
                'card_links' => "",
            ]) . '</div>';

            if(!in_array( $room->apartment_id, $search_apm_ids)){
//              $searching_title .= "<span class='badge rounded-pill bg-label-dark mx-1 my-1'>{$apm->address_street}</span>";
                $search_apm_ids [] = $room->apartment_id;
            }
        }

        $apartment_count = count($search_apm_ids);
        $district_name = $this->GhDistrict->getNameByCode($district_code);

        $searching_title .= "<span class='badge rounded-pill bg-label-dark mx-1 my-1'>Quận {$district_name}</span>";
        $searching_title .= "<span class='badge rounded-pill bg-label-dark mx-1 my-1'>{$apartment_count} dự án</span>";
        $searching_title .= "<span class='badge rounded-pill bg-label-dark mx-1 my-1'>{$room_count} phòng</span>";
        $searching_title .= "<span class='badge rounded-pill bg-label-dark mx-1 my-1'>Giá giảm dần</span>";

        return $this->response->setJSON([
            'status' => true,
            'room_board' => $cards,
            'searching_title' => $searching_title
        ]);
    }

}
