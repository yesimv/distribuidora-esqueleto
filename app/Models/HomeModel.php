<?php

namespace App\Models;

use App\Core\Logger;
use App\Services\ApiClient;

class HomeModel{

    private $api;

    public function __construct()
    {
        $this->api = new ApiClient('administrativo');
    }

    public function dataEmployee(){
        try {

            $response = $this->api->request("GET","empleado");

            return $response;
            
        } catch (\Exception $e) {

            Logger::module("HomeModel", "Error al obtener datos de la Api en la ruta empleado, error: " . $e->getMessage());

            throw new \Exception("Error comunicando con la API auth");
        }
    }

    public function aniversarios(){
        try {

            $response = $this->api->request("GET","empleado/aniversarios");

            return $response;
            
        } catch (\Exception $e) {

            Logger::module("HomeModel", "Error al obtener datos de la Api en la ruta empleado/aniversarios, error: " . $e->getMessage());

            throw new \Exception("Error comunicando con la API auth");
        }
    }

    public function cumpleanos(){
        try {

            $response = $this->api->request("GET","empleado/birthdays");

            return $response;
            
        } catch (\Exception $e) {

            Logger::module("HomeModel", "Error al obtener datos de la Api en la ruta empleado/birthdays, error: " . $e->getMessage());

            throw new \Exception("Error comunicando con la API auth");
        }
    }

}

?>