<?php

namespace App\Controllers\web;

use App\Core\BaseController;

class SistemaController extends BaseController
{
    public function index()
    {
      
     $this->view('sistema/main-sis-ticket',[]);     
    }

    
}
