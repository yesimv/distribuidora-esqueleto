<?php

namespace App\Controllers\web;

use App\Core\BaseController;
use App\Core\Config;

class AuthController extends BaseController{

    public function index(){
        $this->view('auth/signin',[],null);
    }

    public function forget(){
        $this->view('auth/forget',[],null);
    }

    public function restart(){
        $this->view('auth/restart',[],null);
    }

    public function restartPwd(){
        $this->view('auth/newpass',[]);
    }

    public function perfil(){
        $this->view('auth/perfil',[]);
    }

    public function logOut()
    {   
        session_unset();
        session_destroy();
        header("Location:".Config::get('app.base_url')."/");
        exit;
    }
    

    

}

?>