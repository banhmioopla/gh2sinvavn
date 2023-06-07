<?php

namespace App\Models;

use CodeIgniter\Model;


class GhApartment extends Model
{
    protected $table = "gh_apartment";


    protected function initialize()
    {
        $this->protect(false);
    }

    public function get($where = []){
        return $this->asObject()->where($where)->findAll();
    }

    public function getFirstById($id){
        return $this->asObject()->where(['id' => $id])->first();
    }

}