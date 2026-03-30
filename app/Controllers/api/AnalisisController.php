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
        public function getAnalisis()
    {
        $this->validateMethod('POST');
        $data = $this->getJsonInput();  //atrapa los datos que le mandaste en el POST
        $analisisService = $this->analisisService;
        
        $result = $analisisService->getAnalisis($data);

        $this->json($result);
    }
    public function date()
    {
        
        $this->validateMethod('POST');
        $data = $this->getJsonInput();  //atrapa los datos que le mandaste en el POST
        $analisisService = $this->analisisService;
        $result = $analisisService->rangoFecha($data);
        
        
        $this->json($result);
    }
    //se traen todos los valores posibles para el formulario de analisis
    public function formData()
    {
        $this->validateMethod('GET');
        $data = $this->getJsonInput();  //atrapa los datos que le mandaste en el POST

        $analisisService = $this->analisisService;
        $result = $analisisService->formData($data);

        $this->json($result);
    }
    
}
