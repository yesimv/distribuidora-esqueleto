<?php

namespace App\Controllers\api;

use App\Core\BaseController;
use App\Services\AnalisisService;

class AnalisisController extends BaseController
{

    private $analisisService;

    public function __construct()
    {
        $this->analisisService = new AnalisisService();
    }

    public function index()
    {
        
        $this->validateMethod('GET');
        $data = $this->getJsonInput();  //atrapa los datos que le mandaste en el POST
        $analisisService = $this->analisisService;
        $result = $analisisService->index($data);
        
        
        $this->json($result);
    }
    
}
