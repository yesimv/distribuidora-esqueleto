<?php

namespace App\Services;

use App\Core\Logger;
use App\Models\AnalisisModel;

class AnalisisService
{

    private $model;

    public function __construct()
    {
        $this->model = new AnalisisModel();
    }
    public function index(array $data)
    {

        try {
            $response = $this->model->index($data);
            $listaAnalisis = [];

            foreach ($response['body']['resultado'] as $index => $registro) {

                $tiempoEst = gmdate('H:i', $registro['tiempo_est']);
                $tiempoReal = gmdate('H:i', $registro['tiempo_real']);
                $listaAnalisis[$index] = [
                    'id_ticket' => $registro['id_ticket'],
                    'id_analisis_tecnico' => $registro['id_analisis_tecnico'],
                    'resolucion' => $registro['resolucion'],
                    'id_resolucion' => $registro['id_resolucion'],
                    'causa' => $registro['causa'],
                    'solucion' => $registro['solucion'],
                    'comentarios' => $registro['comentarios'],
                    'tiempo_est' => $tiempoEst,
                    'tiempo_real' => $tiempoReal

                ];
            };
            $listaConEstilos = $this->ticketTables($listaAnalisis);
            Logger::module('Tickets', 'Datos nuevos', $listaConEstilos);
            return $listaConEstilos;
        } catch (\Exception $e) {
            Logger::module('Analisis', 'Error en la funcion index al llenar el array ' . $e, [$response, $listaAnalisis]);
        }
    }
    public function rangoFecha(array $data)
    {

        try {
            $response = $this->model->rangoFecha($data);
            $listaAnalisis = [];

            foreach ($response['body']['resultado'] as $index => $registro) {

                $listaAnalisis[$index] = [
                    'id_ticket' => $registro['id_ticket'],
                    'id_analisis_tecnico' => $registro['id_analisis_tecnico'],
                    'resolucion' => $registro['resolucion'],
                    'causa' => $registro['causa'],
                    'solucion' => $registro['solucion'],
                    'comentarios' => $registro['comentarios'],
                    'tiempo_est' => $registro['tiempo_est'],
                    'tiempo_real' => $registro['tiempo_real']

                ];
            };

            Logger::module('Tickets', 'Datos nuevos', $listaAnalisis);
            return $listaAnalisis;
        } catch (\Exception $e) {
            Logger::module('Analisis', 'Error en la funcion index al llenar el array ' . $e, [$response, $listaAnalisis]);
        }
    }
    //traer datos del formulario
    public function formData(array $data)
    {
        try {

            $response = $this->model->formData($data);

            $registro = $response['body']['resultado'];

            $opcionFormulario = [
                'resolucion' => $registro['resolucion']
            ];




            Logger::module('Analisis', 'Datos nuevos', $opcionFormulario);
            return $opcionFormulario;
        } catch (\Exception $e) {
            Logger::module('Analisis', 'Error en la funcion index al llenar el array ' . $e);
        }
    }

    public function ticketTables($data)
    {
        foreach ($data as &$ticket) {
            //se agrega la clase para estatus
            $ticket['resolucion_class'] = match ((int)$ticket['id_resolucion']) {
                1 => 'btn-success-light-mini',
                2 => 'btn-warning-light-mini',
                3 => 'btn-primary-light-mini',
                4 => 'btn-light-light-mini',
                default => 'btn-dark-light-mini',
            };
        }
        return $data;
    }
}
