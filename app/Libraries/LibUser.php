<?php
namespace App\Libraries;

use App\Models\GhContract;
use App\Models\GhDistrict;
use App\Models\GhUser;

use Firebase\JWT\Key;
use stdClass;

class LibUser
{
    private GhUser $GhUser;
    private GhContract $GhContract;

    public function __construct()
    {
        $this->GhUser = new GhUser();
        $this->GhContract = new GhContract();

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
        $range_node = [5,10,20,50,80,100,200,300,400];
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
}