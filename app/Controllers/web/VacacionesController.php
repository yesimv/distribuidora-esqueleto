<?php

namespace App\Controllers\web;

use App\Core\BaseController;

class VacacionesController extends BaseController{

    public function index(){
        $this->view('vacaciones/vacaciones-solicitar',[]);
    }

    public function contabilidad(){
        $this->view('vacaciones/vacaciones-contabilidadp',[]);
    }

    public function nomina(){
        $this->view('vacaciones/vacaciones-nomina',[]);
    }

}

?>