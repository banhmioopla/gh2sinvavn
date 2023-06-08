<?php
namespace App\Libraries;

use App\Models\GhDistrict;
use App\Models\GhUser;

class LibAuth
{
    private GhUser $GhUser;

    public function __construct()
    {
        $this->GhUser = new GhUser();
    }

    public function validateAuth($data):bool{
        $phone_number = $data['phone_number'];
        $password = $data['password'];

        $checker = $this->GhUser->getFirst([
            'phone_number' => $phone_number,
            'password' => $password,
            'active' => 'YES',
        ]);

        if($checker){
            session()->set('auth_data', $checker);
            session()->set('is_login', true);
            response()->setCookie('phone_number', $phone_number, ['expires' => time() + 60*60*24*20]);
            response()->setCookie('password', $password, ['expires' => time() + 60*60*24*20]);
        } else {
            session()->set('is_login', false);
        }

        return session()->get('is_login');
    }

}
