<?php

namespace Modules\Layouts\Controllers;
date_default_timezone_set('Asia/Ho_Chi_Minh');

use App\Libraries\LibApartment;
use App\Libraries\LibUser;
use App\Models\GhApartment;
use App\Models\GhCustomer;
use App\Models\GhDistrict;
use App\Models\GhMedia;
use App\Models\GhContract;
use App\Models\GhRoom;
use App\Models\GhUser;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['html','url','form'];
    protected LibApartment $LibApartment;
    protected GhApartment $GhApartment;
    protected GhRoom $GhRoom;
    protected GhMedia $GhMedia;
    protected GhDistrict $GhDistrict;
    protected GhContract $GhContract;
    protected GhUser $GhUser;
    protected GhCustomer $GhCustomer;
    protected LibUser $LibUser;

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);
        $this->LibApartment = new LibApartment();
        $this->GhApartment = new GhApartment();
        $this->GhRoom = new GhRoom();
        $this->GhMedia = new GhMedia();
        $this->GhDistrict = new GhDistrict();
        $this->GhContract = new GhContract();
        $this->GhUser = new GhUser();
        $this->LibUser = new LibUser();
        $this->GhCustomer = new GhCustomer();
    }
}
