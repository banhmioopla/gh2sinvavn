<?php

use Config\Services;

/** @var Services $routes */

$routes->group('apm', ['namespace' => 'Modules\Apartment\Controllers'], static function ($routes) {
    $routes->get('downloader/preview', 'Downloader::preview');
    $routes->get('sightseeing', 'Apartment::sightseeing');
    $routes->get('searching-room', 'Apartment::searchingRoom');
    $routes->get('contract/new', 'Contract::create');

    $routes->get('downloader/dropdown-apartment', 'Downloader::dropdownApartment');
    $routes->get('downloader/dropdown-room', 'Downloader::dropdownRoom');
    $routes->post('downloader/submit-download', 'Downloader::submitDownload');
});