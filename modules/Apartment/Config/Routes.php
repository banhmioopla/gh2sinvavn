<?php
use App\Libraries\LibApartment;
use App\Models\GhRoom;


/** @var \CodeIgniter\Router\RouteCollection $routes */

$routes->group('apm', ['namespace' => 'Modules\Apartment\Controllers'], static function ($routes) {
    $routes->get('downloader/preview', 'Downloader::preview');
    $routes->get('sightseeing', 'Apartment::sightseeing');
    $routes->get('searching-room', 'Apartment::searchingRoom');
    $routes->get('contract/new', 'Contract::create');

    $routes->get('downloader/dropdown-apartment', 'Downloader::dropdownApartment');
    $routes->get('downloader/dropdown-room', 'Downloader::dropdownRoom');
    $routes->post('downloader/submit-download', 'Downloader::submitDownload');

    $routes->get('dropdown-room', static function(){
        $apartment_id = request()->getGet('apartment_id');
        return response()->setJSON(
            (new LibApartment())->dropdownRoomSelect2($apartment_id)
        );
    });

    $routes->get('dropdown-apartment', static function(){
        $district_code = request()->getGet('district_code');
        return response()->setJSON(
            (new LibApartment())->dropdownApartmentSelect2($district_code)
        );
    });

    $routes->get('room-info', static function(){
        $room_id = request()->getGet('room_id');

        return response()->setJSON([
            'status' => true,
            'room_info' => (new GhRoom())->getFirstById($room_id)
        ]);
    });

});