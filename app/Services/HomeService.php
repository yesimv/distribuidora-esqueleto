<?php

namespace App\Services;

use App\Core\Logger;
use App\Models\HomeModel;

class HomeService
{

    private $model;

    public function __construct()
    {
        $this->model = new HomeModel();
    }

    public function dashboardSup()
    {
        try {

            $empleado = $this->model->dataEmployee();
            $empleadoResult = $empleado['body']['resultado'][0];
            $status = $empleado['status'];
            $aniversarios = $this->model->aniversarios();
            $aniversariosResult = $aniversarios['body']['resultado'];
            $aniFinal = [];
            $cumpleanos = $this->model->cumpleanos();
            $cumpleanosResult = $cumpleanos['body']['resultado'];
            $cumpleFinal = [];

            if ($status == 400) {
                return [
                    "success" => false,
                    "message" => $empleado['body']['mensaje']
                ];
            }

            if ($status == 200) {

                foreach($aniversariosResult as $ani){
                    $aniFinal[] = [
                        'fch_ingreso' => $ani['fch_ingreso'],
                        'empleado' => $ani['nombre_emp'].' '.$ani['apellido_paterno'].' '.$ani['apellido_materno'],
                    ];
                }

                foreach($cumpleanosResult as $cumple ){
                    $cumpleFinal[] = [
                        'fch_nac' => $cumple['fch_nac'],
                        'empleado' => $cumple['nombre_emp'].' '.$cumple['apellido_paterno'].' '.$cumple['apellido_materno'],
                    ];
                }

                return [
                    "success" => true,
                    "message" => $empleado['body']['mensaje'],
                    "respuesta" =>
                    [
                        'anios_laborados' => $empleadoResult['anios_laborados'],
                        'vacaciones_correspondientes' =>  $empleadoResult['vacaciones_correspondientes'],
                        'vacaciones_pendientes' => $empleadoResult['vacaciones_pendientes'],
                        'vacaciones_disfrutadas' => $empleadoResult['vacaciones_disfrutadas'],
                        'aniversarios'=>$aniFinal,
                        'cumpleanos'=>$cumpleFinal,
                    ]
                ];
            }

            Logger::php("Respuesta inesperada Auth API", $empleado);

            throw new \Exception("Respuesta inesperada del servicio");
        } catch (\Exception $e) {
            Logger::php("Excepción en HomeServices en dashboardSup", [
                "error" => $e->getMessage()
            ]);

            return [
                "success" => false,
                "message" => "Servicio no disponible"
            ];
        }
    }
}
