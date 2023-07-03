<?php

if (! function_exists('get_config')) {
    function get_config($code):string|null{
        return (new \App\Models\GhConfig())->getFirst(['code' => $code])?->value;
    }
}


if (! function_exists('get_admin_accounts')) {
    function get_admin_accounts():array{
        $values = get_config('admin_accounts');
        return $values ? json_decode($values) : [];
    }
}

if (! function_exists('is_admin')) {
    function is_admin():bool{
        return in_array(session()->get('auth_data')?->account_id,get_admin_accounts());
    }
}

if (! function_exists('get_admin_pin_code')) {
    function get_admin_pin_code():bool{
        return get_config('admin_pin_code');
    }
}

if (! function_exists('get_admin_pin_code')) {
    function get_admin_pin_code():bool{
        return get_config('admin_pin_code');
    }
}

if (! function_exists('get_open_districts')) {
    function get_open_districts():string|null{
        return get_config('open_districts');
    }
}

if (! function_exists('get_open_districts')) {
    function get_open_districts():string|null{
        return get_config('open_districts');
    }
}