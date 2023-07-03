<?php
namespace App\Libraries;

use App\Models\GhApartment;
use App\Models\GhContract;
use App\Models\GhCustomer;
use App\Models\GhRoom;
use App\Models\GhUser;


class LibUser
{
    private GhUser $GhUser;
    private GhContract $GhContract;
    private LibApartment $LibApartment;
    private GhApartment $GhApartment;
    private GhCustomer $GhCustomer;
    private GhRoom $GhRoom;

    public function __construct()
    {
        $this->GhUser = new GhUser();
        $this->GhContract = new GhContract();
        $this->LibApartment = new LibApartment();
        $this->GhApartment = new GhApartment();
        $this->GhCustomer = new GhCustomer();
        $this->GhRoom = new GhRoom();

    }

    public function getShortUserName($account_id):string{
        $user_name = trim($this->GhUser->getNameByAccountId($account_id));
        if(!empty($user_name)){
            $arr = explode(' ' , $user_name);
            if(count($arr) > 2){
                return $arr[count($arr) - 2] . ' ' . $arr[count($arr) - 1];
            }
        }

        return $user_name;
    }

    public function getContract($account_id, $where = ""):array{
        helper('array');


        $where_query =  " ORD(arr_supporter_id) > 0";
        if(!empty($where)){
            $where_query .= " AND {$where}";
        }

        $query = /** @lang */ <<<SQL
        SELECT gh_contract.*,  JSON_CONTAINS(JSON_EXTRACT(arr_supporter_id, "$[*]"), '"{$account_id}"') AS in_array 
        FROM gh_contract WHERE JSON_CONTAINS(JSON_EXTRACT(arr_supporter_id, "$[*]"), '"{$account_id}"') = '1' AND $where_query
        SQL;

        $list_filter_support = $this->GhContract->db->query($query)->getResult();


        $where_query = "consultant_id = {$account_id} AND status <> 'Cancel' ";
        if(!empty($where)){
            $where_query .= " AND {$where}";
        }

        $list_filter_consultant = $this->GhContract->get($where_query);

        $contracts = [...$list_filter_support, ...$list_filter_consultant];
        array_sort_by_multiple_keys($contracts, ['id' => SORT_DESC]);
        return $contracts;
    }

    public function getTotalSale($account_id):float{
        $list = $this->getContract($account_id);
        $total = 0;
        foreach ($list as $item){
            $rate_type = (1- $item->rate_type);
            if($item->consultant_id === $account_id){
                $rate_type = $item->rate_type;
            }

            $total += $rate_type * $item->room_price * $item->commission_rate/100;
        }

        return $total;
    }

    public function getTotalSaleByContract($contract){
        $rate_type = (1- $contract->rate_type);
        if($contract?->in_array == 1){
            $rate_type = $contract->rate_type;
        }

        return $rate_type * $contract->room_price * $contract->commission_rate/100;
    }

    public function contractCountProgress($amount):string{
        $range_node = [5,10,20,50,80,100,200,300,400,500];
        $progress = [];

        foreach ($range_node as $item){
            if($amount >= $item){
                if($item < 100){
                    $progress []= '<span class="badge badge-center rounded-pill bg-primary">'.$item.'</span>';
                } else {
                    $progress []= '<span class="fw-bold text-primary align-middle h4"><span class="badge badge-dot bg-primary me-1"></span> '.$item.'</span>';
                }

                continue;
            }

            if($item < 100){
                $progress[]= '<span class="badge badge-center rounded-pill bg-secondary">'.$item.'</span>';
            } else {
                $progress []= '<span class="fw-bold align-middle h4"><span class="badge badge-dot bg-secondary me-1"></span> '.$item.'</span>';
            }
            break;
        }

        return implode('<i class="ti ti-chevrons-right mx-2"></i>', count($progress) > 4 ? array_splice($progress, -4)  : $progress);
    }

    public function contractSaleProgress($amount):string{
        $range_node = [5,10,20,50,80,100,200,300,400,500,800,1000];
        $progress = [];

        foreach ($range_node as $item){
            if($amount >= $item*1000000){
                if($item < 10){
                    $progress []= '<span class="badge badge-center rounded-pill bg-primary">'.$item.'tr</span>';
                } else {
                    $progress []= '<span class="fw-bold text-primary align-middle h5"><span class="badge badge-dot bg-primary me-1"></span> '.$item.'tr</span>';
                }

                continue;
            }

            if($item < 10){
                $progress[]= '<span class="badge badge-center rounded-pill bg-secondary">'.$item.'tr</span>';
            } else {
                $progress []= '<span class="fw-bold align-middle h5"><span class="badge badge-dot bg-secondary me-1"></span> '.$item.'tr</span>';
            }
            break;
        }

        return implode('<i class="ti ti-chevrons-right mx-2"></i>', count($progress) > 4 ? array_splice($progress, -4)  : $progress);
    }


    public function renderContractTable($account_id, $where = []):string{
        $head = ['id', 'Dự Án', 'Doanh Số', 'Khách Thuê',  '<div class="text-center">Ngày Hết Hạn</div>', '★'];
        $data = [];

        foreach ($this->getContract($account_id, $where) as $contract){
            $apm = $this->GhApartment->getFirstById($contract->apartment_id);
            $customer_name = $this->GhCustomer->getNameById($contract->customer_id);
            $room = $this->GhRoom->getFirstById($contract->room_id);

            $user_supports = [];

            // map user.account_id => user.name
            if(is_array(json_decode($contract?->arr_supporter_id)) && count(json_decode($contract?->arr_supporter_id))){
                $user_supports = array_map(fn($element) =>
                    $this->getShortUserName($element), json_decode($contract?->arr_supporter_id)
                );
            }

            $data[] = [
                $contract->id,
                 '<span class="badge bg-primary">'.$room?->code.'</span>'
                . ('<small class="d-block my-1">Dự án <strong>'.$this->LibApartment->getFullAddress($apm).'</strong></small>')
                . ('<small class="me-2">HHKG <strong>'.$contract->commission_rate.'%</strong></small>')
                . ('<small class="me-2">Giá thuê <strong>'.number_format($contract->room_price).'</strong></small>')
                . (count($user_supports) ? '<small class="me-2"> Hỗ trợ: <strong>'.implode(" , ", $user_supports) .'</strong></small>' : ''),
                number_format((new LibContract())->getSaleAmount($contract->id)),
                '<small class="fw-bolder">'.mb_strtoupper($customer_name).'</small>',
                '<div class="text-center">'.date('d/m/y', $contract->time_expire).'</div>',
                $contract->rate_type
            ];
        }

        return render_table($head, $data, ['data-head-label' => 'Danh sách hợp đồng']);
    }


    public function incomePreview($account_id):object{

        $income_data = [];
        $default_time = get_default_time_range();

        $time_from = strtotime($default_time->time_from);
        $time_to = strtotime($default_time->time_to) + 86399;

        $where = "{$time_from} <= gh_contract.time_check_in AND gh_contract.time_check_in <= {$time_to}";
        $list_contract = $this->getContract($account_id, $where);
        $contract_count = count($list_contract);



        foreach ($list_contract as $contract){
            $total_sale = (new LibContract())->getSaleAmount($contract->id);
            $total_sale_after_cost = $total_sale - $contract->contract_cost;

            $income_data []= (object)[
                'contract_id' => $contract->id,
                'total_sale' => $total_sale,
                'total_sale_after_cost' => $total_sale_after_cost,
                'income_amount_preview' => 0,
                'income_amount' => 0,
                'address_info' => (new LibContract())->getAddressInfo($contract->id),
            ];
        }

        return (object)[
            'income_data' => $income_data,
            'contract_count' => $contract_count
        ];
    }


}