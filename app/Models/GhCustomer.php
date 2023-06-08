<?php

namespace App\Models;

use CodeIgniter\Model;


class GhCustomer extends Model
{
    protected $table = "gh_customer";


    protected function initialize()
    {
        $this->protect(false);
    }

    public function get($where = [] , $orderBy = 'id DESC'){
        return $this->asObject()->orderBy($orderBy)->where($where)->findAll();
    }

    public function getFirstById($id, $orderBy = 'id DESC'){
        return $this->asObject()->orderBy($orderBy)->where(['id' => $id])->first();
    }

    public function getFirst($where = [], $orderBy = 'id DESC'){
        return $this->asObject()->orderBy($orderBy)->where($where)->first();
    }

    public function getNameById($id){
        return $this->getFirst([
            'id' => $id
        ])?->name;
    }

    public function getPhoneNumberById($id){
        return $this->getFirst([
            'id' => $id
        ])?->phone;
    }
}