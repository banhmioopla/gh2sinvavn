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
