<?php

namespace App\Models;

use CodeIgniter\Model;


class GhConfig extends Model
{
    protected $table = "gh_config";


    protected function initialize()
    {
        $this->protect(false);
    }

    public function get($where = [] , $orderBy = 'code DESC'){
        return $this->asObject()->orderBy($orderBy)->where($where)->findAll();
    }

    public function getFirst($where = [], $orderBy = 'code ASC'){
        return $this->asObject()->orderBy($orderBy)->where($where)->first();
    }

}