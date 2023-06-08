<?php

namespace App\Models;

use CodeIgniter\Model;


class GhSaveSearchingApartment extends Model
{
    protected $table = "gh_save_searching_apartment";


    protected function initialize()
    {
        $this->protect(false);
    }

    public function get($where = [] , $orderBy = 'id DESC'){
        return $this->asObject()->orderBy($orderBy)->where($where)->findAll();
    }

    public function getFirst($where = []){
        return $this->asObject()->where($where)->first();
    }

    public function getNameByAccountId($account_id){
        return $this->getFirst([
            'account_id' => $account_id
        ])?->name;
    }

}