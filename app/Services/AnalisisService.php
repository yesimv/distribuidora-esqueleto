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
            
            foreach($response['body']['resultado'] as $index => $registro){

                $listaAnalisis[$index] = [
                    'id_ticket' => $registro['id_ticket'],
                    'id_analisis_tecnico' => $registro['id_analisis_tecnico'],
                    'id_resolucion' => $registro['id_resolucion'],
                    'causa' => $registro['causa'],
                    'solucion' => $registro['solucion'],
                    'comentarios' => $registro['comentarios'],
                    'tiempo_est' => $registro['tiempo_est'],
                    'tiempo_real' => $registro['tiempo_real']

                ];
            } ;

            Logger::module('Tickets','Datos nuevos',$listaAnalisis);
            return $listaAnalisis;
        } catch (\Exception $e) {
            Logger::module('Analisis', 'Error en la funcion index al llenar el array ' . $e, [$response, $listaAnalisis]);
        }
    }

}
