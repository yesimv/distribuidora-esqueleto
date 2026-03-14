<?php

namespace App\Controllers\web;

use App\Core\BaseController;
use App\Auth\AuthUser;

class HomeController extends BaseController{

    public function index(){
      $this->view('dashboards/dashboard',[]);       
    }

    

}