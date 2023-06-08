<?php
namespace Modules\Layouts\Controllers;

use App\Libraries\LibApartment;
use App\Libraries\LibAuth;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use ZipArchive;

class Home extends BaseController
{
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger); // TODO: Change the autogenerated stub
    }


    public function index()
    {

        $LibAuth = new LibAuth();

        $LibAuth->jwtCookieAuth();
        if(is_login()){
            $account_id = session()->get('auth_data')?->account_id;
            $contracts = $this->LibUser->getContract($account_id);
            $progress = $this->LibUser->contractCountProgress(count($contracts));
            $contract_table = $this->LibUser->renderContractTable($account_id);

            return view('\Modules\Layouts\Views\home\index',[
                'progress' => $progress,
                'contract_count' => count($contracts),
                'contract_table' => $contract_table,
            ]);
        }


        return view('\Modules\Auth\Views\login\index',[
        ]);
    }

    public function dropdownApartment():ResponseInterface{
        $district_code = $this->request->getGet('district_code');

        $list_apartment = [0 => "Chọn Dự Án"];

        foreach ($this->GhApartment->get(['district_code' => $district_code, 'active' => 'YES']) as $item){
            $list_apartment[$item->id] = $item->address_street;
        }

        if(count($list_apartment) < 2){
            return $this->response->setJSON([
                'msg' => "Không Có Dự Án",
                'status' => false,
            ]);
        }

        $dropdown = form_dropdown("dropdown-apartment",$list_apartment,"",  [
            'class' => 'form-control select2',
            'id' => 'dropdown-apartment'
        ]);

        return $this->response->setJSON([
            'dropdown' => $dropdown,
            'status' => true,
        ]);
    }

}
