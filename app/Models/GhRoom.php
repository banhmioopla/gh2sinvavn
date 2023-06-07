<?php

namespace App\Models;

use CodeIgniter\Model;


class GhRoom extends Model
{
    protected $table = "gh_room";


    protected function initialize()
    {
        $this->protect(false);
    }

    public function get($where = [] , $orderBy = 'id DESC'){
        return $this->asObject()->orderBy($orderBy)->where($where)->findAll();
    }

    public function getFirstById($id){
        return $this->asObject()->where(['id' => $id])->first();
    }

}