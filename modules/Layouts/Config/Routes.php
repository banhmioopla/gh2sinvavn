<?php

use Config\Services;

/** @var Services $routes */

$routes->group('', ['namespace' => 'Modules\Layouts\Controllers'], static function ($routes) {
    $routes->get('home', 'Home::index');
    $routes->get('load/form-add-new-contract', 'LoadUi::formAddNewContract');
    $routes->get('admin/tools', 'LoadUi::formAddNewContract');
});