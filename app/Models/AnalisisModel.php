<?php

namespace App\Models;

use App\Services\ApiClient;
use Exception;

class AnalisisModel
{

    private $api;

    public function __construct()
    {
        $this->api = new ApiClient('ticket');
    }
    public function index(array $data)
    {
        try {
            $response = $this->api->request('GET', 'analisis',$data);
            return $response;
        } catch (Exception $e) {
            return [
                'success'=> false,
                'message'=> 'Error al conectarse a la API tickets: '. $e
                ];
        }
    }
    public function rangoFecha(array $data)
    {
        try {
            
            
            $fechaInicio = $data['fchInicio'];
            $fechaFinal = $data['fchFinal'];
            $rangoFechas = strval('analisis/date?fchInicio='.$fechaInicio.'&fchFinal='.$fechaFinal);
            
             
            $response = $this->api->request('GET', $rangoFechas);
            return $response;
        } catch (Exception $e) {
            return [
                'success'=> false,
                'message'=> 'Error al conectarse a la API tickets: '. $e
                ];
        }
    }
    public function formData(array $data)
    {
        try {
            
            $response = $this->api->request('GET', 'analisis/get-form-data');
            return $response;
        } catch (Exception $e) {
            return [
                'success'=> false,
                'message'=> 'Error al conectarse a la API tickets: '. $e
                ];
        }
    }
    public function create(array $data)
    {
        try {
            
            $response = $this->api->request('POST', 'tickets/create',$data);
            return $response;
        } catch (Exception $e) {
            return [
                'success'=> false,
                'message'=> 'Error al conectarse a la API tickets: '. $e
                ];
        }
    }
}
