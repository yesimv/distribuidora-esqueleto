<?php

namespace App\Controllers\web;

use App\Core\BaseController;

class ComponentController extends BaseController
{
    public function form()
    {  
     $this->view('components/form',[]);     
    }
    public function table()
    {  
     $this->view('components/table',[]);     
    }
    public function blank()
    {  
     $this->view('components/blank',[]);     
    }
    public function profile()
    {  
     $this->view('components/profile',[]);     
    }

}
