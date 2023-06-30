<?php
use App\Libraries\LibApartment;
use App\Models\GhRoom;


/** @var \CodeIgniter\Router\RouteCollection $routes */

$routes->group('cf', ['namespace' => 'Modules\CashFlow\Controllers'], static function ($routes) {
    $routes->get('utilities/calculate-money', 'Utilities::calculate_money');

});