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

    //se obtienen todos los datos
    public function index()
    {

        $this->validateMethod('GET');

        $ticketService = $this->ticketService;

        $result = $ticketService->index();

        $this->json($result);
    }
    public function isCoordinador()
    {
        $this->validateMethod('GET');
        $ticketService = $this->ticketService;
        $result = $ticketService->isCoordinador();
        $this->json($result);
    }
    //se filtra por rango de fechas
    public function date()
    {

        $this->validateMethod('POST');
        $data = $this->getJsonInput();  //atrapa los datos que le mandaste en el POST

        $ticketService = $this->ticketService;
        $result = $ticketService->rangoFecha($data);
        $this->json($result);
    }
    //se traen todos los valores posibles para el formulario de tickets
    public function formData()
    {
        $this->validateMethod('GET');
        

        $ticketService = $this->ticketService;
        $result = $ticketService->formData();

        $this->json($result);
    }
    
    public function create()
    {
        $this->validateMethod('POST');
        $data = $this->getJsonInput();  //atrapa los datos que le mandaste en el POST
        $ticketService = $this->ticketService;
        $result = $ticketService->create($data);

        $this->json($result);
    }
    public function createAnalisis()
    {
        $this->validateMethod('POST');
        $data = $this->getJsonInput();  //atrapa los datos que le mandaste en el POST
        $ticketService = $this->ticketService;
        
        $result = $ticketService->createAnalisis($data);

        $this->json($result);
    }
        public function getTicket()
    {
        $this->validateMethod('POST');
        $data = $this->getJsonInput();  //atrapa los datos que le mandaste en el POST
        $ticketService = $this->ticketService;
        
        $result = $ticketService->getTicket($data);

        $this->json($result);
    }
    public function edit()
    {
        $this->validateMethod('POST');
        $data = $this->getJsonInput();  //atrapa los datos que le mandaste en el POST
        
        $ticketService = $this->ticketService;
        $result = $ticketService->edit($data);
        $this->json($result);
        
    }
    public function borrar()
    {
        $this->validateMethod('POST');
        $data = $this->getJsonInput();  //atrapa los datos que le mandaste en el POST
        $ticketService = $this->ticketService;

        $result = $ticketService->delete($data);

        $this->json($result);
    }

    public function asignar()
    {
        $this->validateMethod('POST');
        $data = $this->getJsonInput();  //atrapa los datos que le mandaste en el POST
       
        $ticketService = $this->ticketService;

        $result = $ticketService->asignar($data);

        $this->json($result);
    }
    public function cambiarEstatus()
    {
        $this->validateMethod('POST');
        $data = $this->getJsonInput();  //atrapa los datos que le mandaste en el POST
       
        $ticketService = $this->ticketService;

        $result = $ticketService->cambiarEstatus($data);

        $this->json($result);
    }
}
