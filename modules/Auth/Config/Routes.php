<?php

use Config\Services;

/** @var Services $routes */

$routes->group('auth', ['namespace' => 'Modules\Auth\Controllers'], static function ($routes) {
    $routes->post('submit-login', 'Login::submitLogin');
    $routes->get('submit-logout', 'Login::submitLogout');
});