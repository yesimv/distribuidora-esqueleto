<?php

namespace App\Services;

use App\Core\Logger;
use App\Models\TicketModel;

class TicketService
{

    private $model;

    public function __construct()
    {
        $this->model = new TicketModel();
    }
    public function index(array $data)
    {
        try {
            $response = $this->model->index($data);
            
            $listaTickets = [];
            foreach ($response['body']['resultado']  as $index => $registro) {
                
                $listaTickets[$index] = [
                    'id_ticket'=>$registro['id_ticket'],
                    'id_estatus'=>$registro['id_estatus'],
                    'id_prioridad'=>$registro['id_prioridad'],
                    'id_area_afectada'=>$registro['id_area_afectada'],
                    'id_canal_contacto'=>['id_canal_comtacto'],
                    'titulo'=>$registro['titulo'],
                    'descripcion'=>$registro['descripcion'],
                    'comentarios'=>$registro['comentarios'],
                    'empleado_solicitante'=>$registro['empleado_solicitante'],
                    'departamento_solicitante'=>$registro['departamento_solicitante'],
                    'estatus'=>$registro['estatus'],
                    'prioridad'=>$registro['prioridad'],
                    'tiempo_estimado'=>$registro['tiempo_estimado'],
                    'empleado_asignado'=>$registro['empleado_asignado'],
                    'area_afectada'=>$registro['area_afectada'],
                    'canal_contacto'=>['canal_comtacto'],
                    'create_date'=>$registro['create_date'],
                ];
            };
            
            
            $listaConEstilos = $this->ticketTables($listaTickets);
            
            Logger::module('Tickets','Datos nuevos',$listaConEstilos);
            return $listaConEstilos;
        } catch (\Exception $e) {
            Logger::module('Tickets','Error en la funcion index al llenar el array '.$e,[$response,$listaTickets]);
        }
    }

    //traer datos del formulario
    public function formData(array $data){
        try {
            $response = $this->model->formData($data);
            return $response;
            $opcionesFormulario = [];
            foreach ($response['body']['resultado']  as $index => $registro) {
                
                $listaTickets[$index] = [
                    'id_ticket'=>$registro['id_ticket'],
                    'id_estatus'=>$registro['id_estatus'],
                    'id_prioridad'=>$registro['id_prioridad'],
                    'id_area_afectada'=>$registro['id_area_afectada'],
                    'id_canal_contacto'=>['id_canal_comtacto'],
                    'titulo'=>$registro['titulo'],
                    'descripcion'=>$registro['descripcion'],
                    'comentarios'=>$registro['comentarios'],
                    'empleado_solicitante'=>$registro['empleado_solicitante'],
                    'departamento_solicitante'=>$registro['departamento_solicitante'],
                    'estatus'=>$registro['estatus'],
                    'prioridad'=>$registro['prioridad'],
                    'tiempo_estimado'=>$registro['tiempo_estimado'],
                    'empleado_asignado'=>$registro['empleado_asignado'],
                    'area_afectada'=>$registro['area_afectada'],
                    'canal_contacto'=>['canal_comtacto'],
                    'create_date'=>$registro['create_date'],
                ];
            };
            
            
            
            
            Logger::module('Tickets','Datos nuevos',$listaConEstilos);
            return $listaConEstilos;
        } catch (\Exception $e) {
            Logger::module('Tickets','Error en la funcion index al llenar el array '.$e,[$response,$listaTickets]);
        }

    }


    public function rangoFecha(array $data){
        try {
            
            $response = $this->model->rangoFecha($data);
            
            $listaTickets = [];
            foreach ($response['body']['resultado']  as $index => $registro) {

                $listaTickets[$index] = [
                    'id_ticket'=>$registro['id_ticket'],
                    'id_estatus'=>$registro['id_estatus'],
                    'id_prioridad'=>$registro['id_prioridad'],
                    'titulo'=>$registro['titulo'],
                    'descripcion'=>$registro['descripcion'],
                    'create_date'=>$registro['create_date']
                ];
            };
            
            
            $listaConEstilos = $this->ticketTables($listaTickets);

            Logger::module('Tickets','Datos nuevos',$listaConEstilos);
            return $listaConEstilos;
        } catch (\Exception $e) {
            Logger::module('Tickets','Error en la funcion index al llenar el array '.$e,[$response,$listaTickets]);
        }
    }



    public function ticketPorFecha(array $data){
        try{
            $fechas = $this->model->rangoFecha($data);
            $listaFechas = [];
            foreach ($fechas['body']['resultado']  as $index => $registro) {

                $listaFechas[$index] = [
                    'id_ticket'=>$registro['id_ticket']
                ];
            };

            $response =[];
            foreach($listaFechas as $index => $valor){

                $response[$index]= $this->model->filtro($valor);
            } 

            $listaTickets = [];
            foreach ($response['body']['resultado']  as $index => $registro) {

                $listaTickets[$index] = [
                    'id_ticket'=>$registro['id_ticket'],
                    'id_estatus'=>$registro['id_estatus'],
                    'id_prioridad'=>$registro['id_prioridad'],
                    'titulo'=>$registro['titulo'],
                    'empleado_solicitante'=>$registro['empleado_solicitante'],
                    'departamento_solicitante'=>$registro['departamento_solicitante'],
                    'estatus'=>$registro['estatus'],
                    'prioridad'=>$registro['prioridad'],
                    'empleado_asignado'=>$registro['empleado_asignado'],
                    'create_date' => $registro['Fecha de creación']

                ];
            };
            $listaConEstilos = $this->ticketTables($listaTickets);

            Logger::module('Tickets','Datos nuevos',$listaConEstilos);
            return $listaConEstilos;

        }catch (\Exception $e) {
            Logger::module('Tickets','Error en la funcion index al llenar el array '.$e,[$response,$listaTickets]);
        }
    }
    //agregar el efecto class en los datos obtenidos

    public function ticketTables($data)
{
    foreach ($data as &$ticket) {
        $ticket['estatus_class'] = match ((int)$ticket['id_estatus']) {
            1 => 'btn-info-light-mini',
            2 => 'btn-warning-light-mini',
            3 => 'btn-success-light-mini',
            4 => 'btn-primary-light-mini',
            5 => 'btn-light-light-mini',
            default => 'btn-dark-light-mini',
        };
    }

    foreach ($data as &$ticket) {
        $ticket['prioridad_class'] = match ((int)$ticket['id_prioridad']) {
            1 => 'btn-success-light-mini',
            2 => 'btn-warning-light-mini',
            3 => 'btn-primary-light-mini',
            4 => 'btn-primary-mini',
            default => 'btn-light-light-mini',
        };
    }

    return $data;
}


}
