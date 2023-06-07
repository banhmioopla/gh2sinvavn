<?php

use Config\Services;

/** @var Services $routes */

$routes->group('apm', ['namespace' => 'Modules\Apartment\Controllers'], static function ($routes) {
    $routes->get('downloader/preview', 'Downloader::preview');

    $routes->get('downloader/dropdown-apartment', 'Downloader::dropdownApartment');
    $routes->get('downloader/dropdown-room', 'Downloader::dropdownRoom');
    $routes->post('downloader/submit-download', 'Downloader::submitDownload');
});