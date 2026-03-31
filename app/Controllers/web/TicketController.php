<?php

namespace App\Controllers\web;

use App\Core\BaseController;

class TicketController extends BaseController
{
    public function index()
    {

        $this->view('tickets/index', ['pageName' => 'Tickets']);
    }
    public function create()
    {

        $this->view('tickets/nuevo-ticket', ['pageName' => 'Crear Ticket']);
    }
    public function dataTable()
    {

        $this->view('tickets/data-table', ['pageName' => 'Tickets']);
    }
    public function editar()
    {   
        $this->view('tickets/componentes/editar-ticket', ['pageName' => 'Editar Ticket']);
      
    }

}
