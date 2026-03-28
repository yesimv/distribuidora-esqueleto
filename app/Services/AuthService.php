<?php

namespace App\Services;

use App\Core\Logger;
use App\Models\AuthModel;

class AuthService
{

    private $AuthModel;

    public function __construct()
    {
        $this->AuthModel = new AuthModel();
    }

    public function authenticate(array $data): array
    {
        try {

            $response = $this->AuthModel->authenticate($data);

            $status = $response['status'];

            if ($status === 200) {
                return [
                    "success" => true,
                    "user" => $response['body']['resultado'],
                ];
            }

            // ⚠ 400 → Error de validación (mensaje de API)
            if ($status === 400) {
                return [
                    "success" => false,
                    "message" => $response['body']['message'] ?? "Datos incorrectos"
                ];
            }

            // 🔐 401 → Token inválido o no autorizado
            if ($status === 401) {
                // Limpiamos sesión
                session_unset();
                session_destroy();

                return [
                    "success" => false,
                    "message" => "Sesión no autorizada"
                ];
            }

            // 💥 500 → Error interno de API
            if ($status >= 500) {

                throw new \Exception("Error interno del servidor de autenticación");
            }

            // 🔎 Cualquier otro caso inesperado
            Logger::php("Respuesta inesperada Auth API", $response);

            throw new \Exception("Respuesta inesperada del servicio");
        } catch (\Exception $e) {

            Logger::php("Excepción en AuthService", [
                "error" => $e->getMessage()
            ]);

            return [
                "success" => false,
                "message" => "Servicio no disponible"
            ];
        }
    }
    
    public function logOut(){
        try{
            $response = $this->AuthModel->logOut();
            $status = $response['status'];
            
            if($status === 200){
                return[
                    "success" => true,
                    "result" => $response['resultado'],
                    "message" =>$response['mensaje']
                ];
            }
        }catch (\Exception $e) {

            Logger::php("Excepción en AuthService", [
                "error" => $e->getMessage()
            ]);

            return [
                "success" => false,
                "message" => "Servicio no disponible"
            ];
        }
    }

    public function forget(array $data): array
    {
        try {

            $response = $this->AuthModel->forget($data);
            $status = $response['status'];
            
            if ($status == 400) {
                return [
                    "success" => false,
                    "message" => $response['body']['mensaje']
                ];
            }

            if($status ==200){
                return [
                    "success" => true,
                    "message" => $response['body']['mensaje']
                ];
            }

            Logger::php("Respuesta inesperada Auth API", $response);

            throw new \Exception("Respuesta inesperada del servicio");
        } catch (\Exception $e) {
            Logger::php("Excepción en AuthService en Forget", [
                "error" => $e->getMessage()
            ]);

            return [
                "success" => false,
                "message" => "Servicio no disponible"
            ];
        }
    }

    public function restart(array $data):array{
        try {

            $response = $this->AuthModel->restart($data);
            $status = $response['status'];
            
            if ($status == 400) {
                return [
                    "success" => false,
                    "message" => $response['body']['mensaje']
                ];
            }

            if($status ==200){
                return [
                    "success" => true,
                    "message" => $response['body']['mensaje']
                ];
            }

            Logger::php("Respuesta inesperada Auth API", $response);

            throw new \Exception("Respuesta inesperada del servicio");
        } catch (\Exception $e) {
            Logger::php("Excepción en AuthService en Restart", [
                "error" => $e->getMessage()
            ]);

            return [
                "success" => false,
                "message" => "Servicio no disponible"
            ];
        }
    }

    public function login(array $data){
        
        $response = $this->AuthModel->login($data);
        return $response;
    }
}
