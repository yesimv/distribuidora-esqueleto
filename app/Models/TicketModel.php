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
    public function index()
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
    public function indexSol()
    {
        try {
            
            $response = $this->api->request('GET', 'tickets/solicitudes');
            return $response;
        } catch (Exception $e) {
            return [
                'success'=> false,
                'message'=> 'Error al conectarse a la API tickets: '. $e
                ];
        }
    }
    public function isCoordinador()
    {
        try {
            
            $response = $this->api->request('GET', 'tickets/is-coordinador');
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
            
            
            $response = $this->api->request('GET', $rangoFechas);
            return $response;
        } catch (Exception $e) {
            return [
                'success'=> false,
                'message'=> 'Error al conectarse a la API tickets: '. $e
                ];
        }
    }
    public function rangoFechaSol(array $data)
    {
        try {
            
            
            $fechaInicio = $data['fchInicio'];
            $fechaFinal = $data['fchFinal'];
            $rangoFechas = strval('tickets/date-solicitudes?fchInicio='.$fechaInicio.'&fchFinal='.$fechaFinal);
            
            
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
    public function formData()
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

    //crear un nuevo ticket
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
        //crear un nuevo ticket
    public function createAnalisis(array $data)
    {
        try {
            
            
            $response = $this->api->request('POST', 'tickets/close',$data);
            return $response;
        } catch (Exception $e) {
            return [
                'success'=> false,
                'message'=> 'Error al conectarse a la API tickets: '. $e
                ];
        }
    }

    //obtener datos del ticket
    public function getTicket(array $data)
    {
        try {
            $id = [$data['id_ticket']];
            
            $response = $this->api->request('GET', 'tickets/complete-info?id='.$data['id_ticket']);
            return $response;
        } catch (Exception $e) {
            return [
                'success'=> false,
                'message'=> 'Error al conectarse a la API tickets: '. $e
                ];
        }
    }
    //obtener datos extra para la logica de los ticket
    public function extraData(array $data)
    {
        try {
            //peticiones GET
            $query = http_build_query($data);
            
            $response = $this->api->request('GET', 'tickets/get-extra-data?'.$query);
            return $response;
        } catch (Exception $e) {
            return [
                'success'=> false,
                'message'=> 'Error al conectarse a la API tickets: '. $e
                ];
        }
    }
    //editar los datos del ticket
    public function edit($idTicket,array $data)
    {
        try {
            
            $response = $this->api->request('POST', 'tickets/update?id='.$idTicket,$data);
            return $response;
        } catch (Exception $e) {
            return [
                'success'=> false,
                'message'=> 'Error al conectarse a la API tickets: '. $e
                ];
        }
    }
    public function delete($data)
    {
        try {
            
            $response = $this->api->request('POST', 'tickets/delete?id='.$data['id_ticket']);
            return $response;
        } catch (Exception $e) {
            return [
                'success'=> false,
                'message'=> 'Error al conectarse a la API tickets: '. $e
                ];
        }
    }
    public function empleados($data)
    {
        try {
            
            $response = $this->api->request('GET','empleados',$data);
            return $response;
        } catch (Exception $e) {
            return [
                'success'=> false,
                'message'=> 'Error al conectarse a la API tickets: '. $e
                ];
        }
    }
    public function estatus()
    {
        try {

            $response = $this->api->request('GET','estatus');
            return $response;
        } catch (Exception $e) {
            return [
                'success'=> false,
                'message'=> 'Error al conectarse a la API tickets: '. $e
                ];
        }
    }
    public function update($idTicket,$data)
    {
        try {
            
            $response = $this->api->request('POST', 'tickets/auto-asignar?id='.$idTicket,$data);
            return $response;
        } catch (Exception $e) {
            return [
                'success'=> false,
                'message'=> 'Error al conectarse a la API tickets: '. $e
                ];
        }
    }

}
