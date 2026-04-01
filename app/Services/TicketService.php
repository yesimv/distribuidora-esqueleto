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
    public function index($tipo = null)
    {
        try {

            if (in_array('solicitados', $tipo)  && $_SESSION['is_superuser'] == 0) {

                $response = $this->model->indexSol();
            } else {
                $response = $this->model->index();
            }

            $departamentos = [];
            $listaTickets = [];
            foreach ($response['body']['resultado']  as $index => $registro) {
                $departamentos[] = $registro['id_departamento_asi'];
                $tiempo = gmdate('H:i', $registro['tiempo_estimado']);
                $listaTickets[$index] = [
                    'id_ticket' => $registro['id_ticket'],
                    'id_estatus' => $registro['id_estatus'],
                    'id_prioridad' => $registro['id_prioridad'],
                    'id_area_afectada' => $registro['id_area_afectada'],
                    'id_canal_contacto' => $registro['id_canal_contacto'],
                    'id_departamento_asi' => $registro['id_departamento_asi'],
                    'id_empleado_asi' => $registro['id_empleado_asi'],
                    'titulo' => $registro['titulo'],
                    'descripcion' => $registro['descripcion'],
                    'comentarios' => $registro['comentarios'],
                    'empleado_solicitante' => $registro['empleado_solicitante'],
                    'departamento_solicitante' => $registro['departamento_solicitante'],
                    'estatus' => $registro['estatus'],
                    'prioridad' => $registro['prioridad'],
                    'tiempo_estimado' => $tiempo,
                    'empleado_asignado' => $registro['empleado_asignado'],
                    'departamento_asignado' => $registro['departamento_asignado'],
                    'area_afectada' => $registro['area_afectada'],
                    'canal_contacto' => $registro['canal_contacto'],
                    'create_date' => $registro['create_date'],
                    'is_delete' => $registro['is_delete'],
                    'id_ticket_relacionado' => $registro['id_ticket_relacionado']
                ];
            };
            if (in_array('solicitados', $tipo)  && $_SESSION['is_superuser'] == 0) {

                $listaConEstilos = $this->ticketTables($listaTickets);
            } else {

                $departamentos = array_unique(array_filter($departamentos));
                $listaDept = ['departamentos' => implode(',', $departamentos)];
                $extraData = $this->model->extraData($listaDept);

                $empleados = $extraData['body']['resultado']['empleados_filtrados'];
                $estatus = $extraData['body']['resultado']['estatus'];

                $listaConEstilos = $this->ticketTables($listaTickets, $empleados, $estatus);
            }


            Logger::module('Tickets', 'Datos nuevos', $listaConEstilos);
            return $listaConEstilos;
        } catch (\Exception $e) {
            Logger::module('Tickets', 'Error en la funcion index al llenar el array ' . $e, [$response, $listaTickets]);
        }
    }


    static public function isCoordinador()
    {
        $ticketModel = new TicketModel();
        try {
            $response = $ticketModel->isCoordinador();

            Logger::module('Tickets', 'Datos nuevos', $response);
            return $response;
        } catch (\Exception $e) {
            Logger::module('Tickets', 'Error al confirmar si es coordinador de su area: ' . $e);
        }
    }
    //traer datos del formulario
    public function formData()
    {
        try {

            $response = $this->model->formData();

            $registro = $response['body']['resultado'];

            $idDepartamentoSol = null;
            $idEmpleadoSol = null;
            $estacionInicial = null;

            if ($_SESSION['es_coordinador'] == true) {
                if ($_SESSION['is_superuser'] == 1) {
                    $idDepartamentoSol = $registro['departamento'];
                    $idEmpleadoSol = $registro['empleado'];
                } else {
                    foreach ($registro['departamento'] as $valor) {
                        if (in_array($valor['id_departamento'], $_SESSION['deptos_coordinador'])) {
                            $idDepartamentoSol[] = $valor;
                        }
                    }
                    foreach ($registro['empleado'] as $valor) {

                        if (in_array($valor['id_departamento'], $_SESSION['deptos_coordinador'])) {
                            $idEmpleadoSol[] = $valor;
                        }
                    }
                }
                $estacionInicial = $registro['estacion'];
            } else {
                foreach ($registro['departamento'] as $valor) {
                    if ($valor['id_departamento'] == $_SESSION['id_departamento']) {
                        $idDepartamentoSol = $valor;
                    }
                }
                foreach ($registro['empleado'] as $valor) {

                    if ($valor['id_empleado'] == $_SESSION['id_empleado']) {
                        $idEmpleadoSol = $valor;
                    }
                }
                foreach ($registro['estacion'] as $valor) {

                    if ($valor['id_estacion'] == $_SESSION['id_estacion']) {
                        $estacionInicial = $valor;
                    }
                }
            };



            $opcionesFormulario = [
                'departamento_sol' => $idDepartamentoSol,
                'empleado_sol' => $idEmpleadoSol,
                'estacion_inicial' => $estacionInicial,
                'estacion' => $registro['estacion'],
                'area_afectada' => $registro['area_afectada'],
                'canal_contacto' => $registro['canal_contacto'],
                'categoria' => $registro['categoria'],
                'departamento' => $registro['departamento'],
                'empleado' => $registro['empleado'],
                'estatus' => $registro['estatus'],
                'lvl_afectacion' => $registro['lvl_afectacion'],
                'prioridad' => $registro['prioridad'],
                'tipo' => $registro['tipo']
            ];


            Logger::module('Tickets', 'Datos nuevos', $opcionesFormulario);
            return $opcionesFormulario;
        } catch (\Exception $e) {
            Logger::module('Tickets', 'Error en la funcion index al llenar el array ' . $e);
        }
    }


    public function rangoFecha(array $data)
    {
        try {
            
            $fechas = $data;
            
            if (isset($data['solicitados'])  && $_SESSION['is_superuser'] == 0) {
                unset($fechas['solicitados']);
                
                $response = $this->model->rangoFechaSol($fechas);
                
            } else {
                $response = $this->model->rangoFecha($fechas);
            }

            if($response['status'] == 200){
                $departamentos = [];
            $listaTickets = [];
            foreach ($response['body']['resultado']  as $index => $registro) {
                $departamentos[] = $registro['id_departamento_asi'];
                $tiempo = gmdate('H:i', $registro['tiempo_estimado']);
                $listaTickets[$index] = [

                    'id_ticket' => $registro['id_ticket'],
                    'id_estatus' => $registro['id_estatus'],
                    'id_prioridad' => $registro['id_prioridad'],
                    'id_area_afectada' => $registro['id_area_afectada'],
                    'id_canal_contacto' => $registro['id_canal_contacto'],
                    'id_departamento_asi' => $registro['id_departamento_asi'],
                    'id_empleado_asi' => $registro['id_empleado_asi'],
                    'titulo' => $registro['titulo'],
                    'descripcion' => $registro['descripcion'],
                    'comentarios' => $registro['comentarios'],
                    'empleado_solicitante' => $registro['empleado_solicitante'],
                    'departamento_solicitante' => $registro['departamento_solicitante'],
                    'estatus' => $registro['estatus'],
                    'prioridad' => $registro['prioridad'],
                    'tiempo_estimado' => $tiempo,
                    'empleado_asignado' => $registro['empleado_asignado'],
                    'departamento_asignado' => $registro['departamento_asignado'],
                    'area_afectada' => $registro['area_afectada'],
                    'canal_contacto' => $registro['canal_contacto'],
                    'create_date' => $registro['create_date'],
                    'is_delete' => $registro['is_delete'],
                    'id_ticket_relacionado' => $registro['id_ticket_relacionado']
                ];
            };

            if (in_array('solicitados', $data)  && $_SESSION['is_superuser'] == 0) {

                $listaConEstilos = $this->ticketTables($listaTickets);
            } else {

                $departamentos = array_unique(array_filter($departamentos));
                $listaDept = ['departamentos' => implode(',', $departamentos)];
                $extraData = $this->model->extraData($listaDept);

                $empleados = $extraData['body']['resultado']['empleados_filtrados'];
                $estatus = $extraData['body']['resultado']['estatus'];

                $listaConEstilos = $this->ticketTables($listaTickets, $empleados, $estatus);
            }
            Logger::module('Tickets', 'Datos nuevos', $listaConEstilos);
            return $listaConEstilos;
            }
            return $response;
            
        } catch (\Exception $e) {
            Logger::module('Tickets', 'Error en la funcion index al llenar el array ' . $e, [$response, $listaTickets]);
        }
    }

    //agregar el efecto class en los datos obtenidos

    public function ticketTables($data, $empleados = null, $estatus = null)
    {
        //para preparar los empleados por departamento
        $empleadosPorDepto = [];
        if (isset($empleados)) {
            foreach ($empleados as $emp) {
                $empleadosPorDepto[$emp['id_departamento']][] = [
                    'id_empleado' => $emp['id_empleado'],
                    'nombre' => $emp['descripcion']
                ];
            }
        }

        //


        foreach ($data as &$ticket) {
            //se agrega la clase para estatus
            $ticket['estatus_class'] = match ((int)$ticket['id_estatus']) {
                1 => 'td-estatus btn-info-light-mini',
                2 => 'td-estatus btn-warning-light-mini',
                3 => 'td-estatus btn-success-light-mini',
                4 => 'td-estatus btn-primary-light-mini',
                5 => 'td-estatus btn-light-light-mini',
                default => 'td-estatus btn-dark-light-mini',
            };
            //se agrega la clase para prioridad
            $ticket['prioridad_class'] = match ((int)$ticket['id_prioridad']) {
                1 => 'btn-success-light-mini',
                2 => 'btn-warning-light-mini',
                3 => 'btn-primary-light-mini',
                4 => 'btn-primary-mini',
                default => 'btn-light-light-mini',
            };
            // se consultan los datos de sesion para personalizar las opciones
            $deptosUsuario = [$_SESSION['id_departamento']];
            $deptosCoordinador = $_SESSION['deptos_coordinador'] ?? [];
            if (!is_array($deptosCoordinador)) {
                $deptosCoordinador = [];
            }

            // unir departamentos
            $deptosUsuario = array_merge($deptosUsuario, $deptosCoordinador);

            // normalizar
            $deptosUsuario = array_map('intval', $deptosUsuario);
            $deptosMap = array_flip($deptosUsuario);

            // super user
            $esSuperUser = ($_SESSION['is_superuser'] ?? "0") == "1";

            $idDepto = (int)($ticket['id_departamento_asi'] ?? 0);

            // 🔒 puede ver asignación
            $ticket['puede_ver_asignacion'] =
                $esSuperUser || isset($deptosMap[$idDepto]);

            // 👑 es jefe (solo coordinador real)
            $ticket['es_jefe_depto'] =
                isset(array_flip(array_map('intval', $deptosCoordinador))[$idDepto]);

            // ⭐ super user override
            if ($esSuperUser) {
                $ticket['es_jefe_depto'] = 1;
            }
            // si eres jefe de departamento y todavia no se guarda el empleado asignado, se agregan las posibles opciones en base al departamento_asignado
            if ($ticket['es_jefe_depto'] && $ticket['id_empleado_asi'] == null && $ticket['id_estatus']) {
                $ticket['empleados_departamento'] =
                    $empleadosPorDepto[$idDepto] ?? [];
            }

            $offset = 0;
            //si es primer estatus solo quita ese pero si es el segundo, se quitan los 2 primeros
            if ($ticket['id_estatus'] == 1) {
                $offset = 1;
            } elseif ($ticket['id_estatus'] == 2) {
                $offset = 2;
            }

            if (isset($estatus)) {
                $ticket['estatus_list'] = array_slice($estatus, $offset);
            }


            $ticket['id_usuario_actual'] = $_SESSION['id_empleado'];
        }



        return $data;
    }

    public function create($data)
    {

        try {


            $nuevoTicket = $this->model->create($data);

            Logger::module('Tickets', 'Datos nuevos', $nuevoTicket);
            return $nuevoTicket;
        } catch (\Exception $e) {
            Logger::module('Tickets', 'Error en la funcion index al llenar el array ' . $e, [$data, $data]);
        }
    }
    public function createAnalisis($data)
    {

        try {

            $nuevoTicket = $this->model->createAnalisis($data);
            Logger::module('Tickets', 'Datos nuevos', $nuevoTicket);
            return $nuevoTicket;
        } catch (\Exception $e) {
            Logger::module('Tickets', 'Error en la funcion index al llenar el array ' . $e, [$data, $data]);
        }
    }
    public function getTicket($data)
    {
        try {
            $ticket = $this->model->getTicket($data);
            Logger::module('Tickets', 'Datos nuevos', $ticket);
            return $ticket;
        } catch (\Exception $e) {
            Logger::module('Tickets', 'Error en la funcion index al llenar el array ' . $e, [$data, $data]);
        }
    }
    public function edit($data)
    {

        try {


            $idTicket = $data['id_ticket'];
            if ($data) unset($data['id_ticket']);
            $editTicket = $this->model->edit($idTicket, $data);

            Logger::module('Tickets', 'Datos nuevos', $editTicket);
            return $editTicket;
        } catch (\Exception $e) {
            Logger::module('Tickets', 'Error en la funcion index al llenar el array ' . $e, [$data, $data]);
        }
    }
    public function delete($data)
    {
        try {
            $ticket = $this->model->delete($data);

            Logger::module('Tickets', 'Datos', $ticket);
            return $ticket;
        } catch (\Exception $e) {
            Logger::module('Tickets', 'Error en la funcion index al llenar el array ' . $e, [$data, $data]);
        }
    }
    public function asignar($data)
    {
        try {

            $asignado = [];
            if (!empty($data['auto'])) {
                $asignado = [
                    'id_empleado_asi' => $_SESSION['id_empleado'],
                ];
            } elseif (!empty($data['id_empleado'])) {
                $asignado = [
                    'id_empleado_asi' => $data['id_empleado'],
                ];
            }
            $idTicket = $data['id_ticket'];

            $ticket = $this->model->update($idTicket, $asignado);

            Logger::module('Tickets', 'Datos', $ticket);
            return $ticket;
        } catch (\Exception $e) {
            Logger::module('Tickets', 'Error en la funcion index al llenar el array ' . $e, [$data, $data]);
        }
    }
    public function cambiarEstatus($data)
    {
        try {


            $idTicket = $data['id_ticket'];
            $idEstatus = ['id_estatus' => $data['estatus']];

            $ticket = $this->model->update($idTicket, $idEstatus);

            Logger::module('Tickets', 'Datos', $ticket);
            return $ticket;
        } catch (\Exception $e) {
            Logger::module('Tickets', 'Error en la funcion index al llenar el array ' . $e, [$data, $data]);
        }
    }
}
