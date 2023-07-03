<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the framework's
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @see: https://codeigniter.com/user_guide/extending/common.html
 */

if (! function_exists('is_login')) {
    function is_login():string{
        return (session()->has('is_login') && session()->get('is_login') === true);
    }
}

if (! function_exists('render_table')) {
    function render_table($heading = [], $data = [], $extra = []):string{
        $table = new \CodeIgniter\View\Table();

        if(!empty($heading)){
            $table->setHeading($heading);
        }

        foreach ($data as $item){
            $table->addRow($item);
        }
        $table_attributes = [];
        if(isset($extra['data-head-label'])){
            $table_attributes['data-head-label'] = $extra['data-head-label'];
        }

        $template = [
            'table_open' => '<table class="table app-custom-datatable" '.stringify_attributes($table_attributes).'>',
            'thead_open' => '<thead class="table-light">'
        ];

        if(isset($extra['template'])){
            $template = $extra['template'];
        }

        $table->setTemplate($template);
        return $table->generate();
    }
}


if (! function_exists('get_cash_time_from')) {
    function get_default_time_range():object{
        $time_from = date("06-m-Y");
        $time_to = date("05-m-Y",strtotime($time_from.' +1 month'));

        if(strtotime(date("d-m-Y")) < strtotime(date("5-m-Y"))+86399){
            $time_from = date("06-m-Y", strtotime("-1 month"));
            $time_to = date("05-m-Y");
        }

        return (object) [
            'time_from' => $time_from,
            'time_to'   => $time_to
        ];
    }
}


if (! function_exists('get_admin_pin_code')) {
    function get_admin_pin_code():string{
        return get_config('admin_pin_code');
    }
}

if (! function_exists('get_list_district_open')) {
    function get_list_district_open():array|null{
        $config = get_config('list_district_open');

        return json_decode($config);
    }
}

if (! function_exists('get_config')) {
    function get_config($code):string{
        $config = (new \App\Models\GhConfig())->getFirst(['code' => $code]);
        return empty($config) ? "" : $config->value;
    }
}

if (! function_exists('get_logo_path')) {
    function get_logo_path():string{
        return base_url('public/assets/img/branding/GIOHANG.png');
    }
}

