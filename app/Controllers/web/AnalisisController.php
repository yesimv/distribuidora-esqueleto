<?php

namespace App\Controllers\web;

use App\Core\BaseController;

class AnalisisController extends BaseController
{
    public function index()
    {
        
     $this->view('analisis/index',['pageName' => 'Análisis Técnicos']);     
    }
    public function create()
    {

        $this->view('analisis/nuevo-analisis', ['pageName' => 'Análisis Técnico']);
    }

}
