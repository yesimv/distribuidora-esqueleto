<?php

namespace App\Controllers\api;

use App\Core\BaseController;
use App\Services\HomeService;

class HomeController extends BaseController
{

    private $homeService;

    public function __construct()
    {
        $this->homeService=new HomeService();
    }

    public function supervisor()
    {
       $this->validateMethod('GET');
       $result = $this->homeService->dashboardSup();
       $this->json($result);
       
    }

    
}
