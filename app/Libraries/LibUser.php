<?php
namespace App\Libraries;

use App\Models\GhDistrict;
use App\Models\GhUser;

use Firebase\JWT\Key;
use stdClass;

class LibUser
{
    private GhUser $GhUser;

    public function __construct()
    {
        $this->GhUser = new GhUser();

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
}