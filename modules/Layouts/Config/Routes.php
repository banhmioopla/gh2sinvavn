<?php

use Config\Services;

/** @var Services $routes */

$routes->group('', ['namespace' => 'Modules\Layouts\Controllers'], static function ($routes) {
    $routes->get('home', 'Home::index');
});