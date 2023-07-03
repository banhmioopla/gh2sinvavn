<?php
namespace App\Libraries;

use App\Models\GhApartment;
use App\Models\GhContract;

class LibContract
{
    public function __construct(){
    }

    public function getSaleAmount($contract_id):float{
        $contract = (new GhContract())->getFirstById($contract_id);
        if(empty($contract)){
            return 0;
        }

        return $contract->room_price * $contract->rate_type * $contract->commission_rate/100;
    }

    public function getNumberDaysRemainExpiry($contract_id):bool|int {
        $contract = (new GhContract())->getFirstById($contract_id);
        if(empty($contract)) return false;

        return (int) (time() < $contract->time_expire ? ($contract->time_expire - time())/86400 : false);
    }

    public function getPartialAmount($contract_id){
    }

    public function getTotalSaleAmountAfterCost($contract_id):float{
        $contract = (new GhContract())->getFirstById($contract_id);
        if(empty($contract)) return false;
        return $this->getSaleAmount($contract_id) - $contract->contract_cost;
    }

    public function getRateApplyIncome($account_id, $number_contract){

    }

    public function getDefaultRateIncomeManager(){

    }

    public function getAddressInfo($contract_id):string{
        $contract = (new GhContract())->getFirstById($contract_id);

        if(empty($contract)){
            return "";
        }

        $user_supports = [];
        if(is_array(json_decode($contract?->arr_supporter_id)) && count(json_decode($contract?->arr_supporter_id))){
            $user_supports = array_map(fn($element) =>
            (new LibUser())->getShortUserName($element), json_decode($contract?->arr_supporter_id)
            );
        }

        $apm = (new GhApartment())->getFirstById($contract->apartment_id);
        $room = $this->GhRoom->getFirstById($contract->room_id);
        $address = $this->LibApartment->getFullAddress($apm);

        return '<span class="badge bg-primary">'.$room?->code.'</span>'
            . ('<small class="d-block my-1">Dự án <strong>'.$address.'</strong></small>')
            . ('<small class="me-2">HHKG <strong>'.$contract->commission_rate.'%</strong></small>')
            . ('<small class="me-2">Giá thuê <strong>'.number_format($contract->room_price).'</strong></small>')
            . (count($user_supports) ? '<small class="me-2"> Hỗ trợ: <strong>'.implode(" , ", $user_supports) .'</strong></small>' : '');
    }


}