<?php
namespace App\Libraries;

use App\Models\GhApartment;
use App\Models\GhContract;
use App\Models\GhCustomer;
use App\Models\GhUser;


class LibUser
{
    private GhUser $GhUser;
    private GhContract $GhContract;
    private LibApartment $LibApartment;
    private GhApartment $GhApartment;
    private GhCustomer $GhCustomer;

    public function __construct()
    {
        $this->GhUser = new GhUser();
        $this->GhContract = new GhContract();
        $this->LibApartment = new LibApartment();
        $this->GhApartment = new GhApartment();
        $this->GhCustomer = new GhCustomer();

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

    public function getContract($account_id){
        return $this->GhContract->get(['consultant_id' => $account_id, 'status <>' => 'Cancel']);
    }

    public function contractCountProgress($count){
        $range_node = [5,10,20,50,80,100,200,300,400,500,600];
        $progress = [];

        foreach ($range_node as $item){
            if($count >= $item){
                if($item < 100){
                    $progress []= '<span class="badge badge-center rounded-pill bg-primary">'.$item.'</span>';
                } else {
                    $progress []= '<span class="fw-bold text-primary"><span class="badge badge-dot bg-primary me-1"></span> '.$item.'</span>';
                }

                continue;
            }
            if($item < 100){
                $progress[]= '<span class="fw-bold"><span class="badge badge-dot bg-secondary me-1"></span> '.$item.'</span>';
            } else {
                $progress []= '<span class="fw-bold"><span class="badge badge-dot bg-secondary me-1"></span> '.$item.'</span>';
            }
            break;
        }

        return implode('<i class="ti ti-arrow-narrow-right mx-2"></i>', $progress);
    }

    public function renderContractTable($account_id):string{
        $head = ['id', 'Dự Án', 'Khách Thuê', 'Ngày Hết Hạn', '★'];
        $data = [];

        foreach ($this->getContract($account_id) as $contract){
            $apm = $this->GhApartment->getFirstById($contract->apartment_id);
            $customer_name = $this->GhCustomer->getNameById($contract->customer_id);

            $data[] = [
                $contract->id,
                $apm?->address_street,
                $customer_name,
                date('d/m/y', $contract->time_expire),
                $contract->rate_type
            ];
        }

        return render_table($head, $data, ['data-head-label' => 'Danh sách hợp đồng']);
    }

}