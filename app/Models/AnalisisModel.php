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
}
