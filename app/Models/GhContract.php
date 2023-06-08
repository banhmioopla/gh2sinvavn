<?php

namespace App\Models;

use CodeIgniter\Model;


class GhContract extends Model
{
    protected $table = "gh_contract";


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

}