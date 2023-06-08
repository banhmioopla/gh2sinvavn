<?php
namespace App\Libraries;

use App\Models\GhDistrict;
use App\Models\GhUser;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use stdClass;

class LibAuth
{
    private GhUser $GhUser;
    const SECRET_SALT = '2X(5LVB@K9Cp?Y-U';
    private JWT $JWT;

    public function __construct()
    {
        $this->GhUser = new GhUser();
        $this->JWT = new JWT();
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
            $key = self::SECRET_SALT;
            $payload = [
                'data' => [
                    'phone_number' => $phone_number,
                    'password' => $password
                ]
            ];
            $jwt = $this->encodeJwt($payload, $key);

            response()->setCookie('token_jwt', $jwt, time() + 60*60*24*20);
        } else {
            session()->set('is_login', false);
        }

        return session()->get('is_login');
    }

    public function jwtCookieAuth():bool{
        if(!empty(request()->getCookie('token_jwt'))){
            $jwt = request()->getCookie('token_jwt');
            $decode_data = $this->decodeJwt($jwt, self::SECRET_SALT);
            return $this->validateAuth([
                'phone_number' => $decode_data->data->phone_number,
                'password' => $decode_data->data->password,
            ]);
        }

        return false;
    }

    public function encodeJwt($payload, $key):string{
        return $this->JWT::encode($payload, $key , 'HS256');
    }

    public function decodeJwt($jwt, $key):stdClass{
        return $this->JWT::decode($jwt, new Key($key, 'HS256'));
    }

}
