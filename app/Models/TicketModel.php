<?php

namespace App\Models;

use App\Services\ApiClient;
use Exception;

class TicketModel
{

    private $api;

    public function __construct()
    {
        $this->api = new ApiClient('ticket');
    }
    public function index(array $data)
    {
        try {
            
            $response = $this->api->request('GET', 'tickets');
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
            $rangoFechas = strval('tickets/date?fchInicio='.$fechaInicio.'&fchFinal='.$fechaFinal);
            
                //$rangoFechas = 'tickets/date?fchInicio=2026-01-01&fchFinal=2026-03-11';
            
            

            
            
            
            
            $response = $this->api->request('GET', $rangoFechas);
            return $response;
        } catch (Exception $e) {
            return [
                'success'=> false,
                'message'=> 'Error al conectarse a la API tickets: '. $e
                ];
        }
    }
    public function filtro($data)
    {
        try {
            $idTicket = $data['id_ticket'];
            $peticionIndividual = strval('tickets/report?id_ticket='.$idTicket);
            $response = $this->api->request('GET', $peticionIndividual);
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
            
            $response = $this->api->request('GET', 'tickets/get-form-data');
            return $response;
        } catch (Exception $e) {
            return [
                'success'=> false,
                'message'=> 'Error al conectarse a la API tickets: '. $e
                ];
        }
    }

}
