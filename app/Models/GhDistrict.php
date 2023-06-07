<?php

namespace App\Models;

use CodeIgniter\Model;


class GhDistrict extends Model
{
    protected $table = "gh_district";


    protected function initialize()
    {
        $this->protect(false);
    }

    public function get($where = []){
        return $this->asObject()->where($where)->findAll();
    }

    public function getFirstByCode($code){
        return $this->asObject()->where(['code' => $code])->first();
    }

    public function getNameByCode($code){

        return $this->getFirstByCode($code)?->name;

    }

}