<?php

namespace App\Controllers\api;

use App\Core\BaseController;
use App\Services\TicketService;

class TicketController extends BaseController
{

    private $ticketService;

    public function __construct()
    {
        $this->ticketService = new TicketService();
    }

    public function index()
    {
        
        $this->validateMethod('GET');
        
        $data = $this->getJsonInput();  //atrapa los datos que le mandaste en el POST
        
        $ticketService = $this->ticketService;
        $result = $ticketService->index($data);
        
        $this->json($result);
    }
    public function date()
    {
        
        $this->validateMethod('POST');
        $data = $this->getJsonInput();  //atrapa los datos que le mandaste en el POST
        
        $ticketService = $this->ticketService;
        $result = $ticketService->rangoFecha($data);
        $this->json($result);
    }
    public function dateFilter()
    {
        
        $this->validateMethod('POST');
        $data = $this->getJsonInput();  //atrapa los datos que le mandaste en el POST
        
        $ticketService = $this->ticketService;
        $result = $ticketService->ticketPorFecha($data);
        $this->json($result);
    }
    public function formData(){
        $this->validateMethod('GET');
        $data = $this->getJsonInput();  //atrapa los datos que le mandaste en el POST
        
        $ticketService = $this->ticketService;
        $result = $ticketService->formData($data);
        
        $this->json($result);
    }
    
}
