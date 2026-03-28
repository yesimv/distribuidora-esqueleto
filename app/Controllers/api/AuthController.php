<?php

namespace App\Controllers\api;

use App\Core\BaseController;
use App\Core\Config;
use App\Services\AuthService;
use App\Core\Logger;
use App\Services\TicketService;


class AuthController extends BaseController
{

    private $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function authenticate()
    {

        $this->validateMethod('POST');

        $data = $this->getJsonInput();

        $email = trim($data['email'] ?? '');

        $password = trim($data['pwd'] ?? '');

        if (empty($email) || empty($password)) {
            $this->error("Todos los campos son obligatorios");
        }

        $authService = $this->authService;

        $result = $authService->authenticate($data);

        if (!$result['success']) {
            return $this->error($result['message'] ?? "Error desconocido");
        }

        $_SESSION['bearer_token'] = $result['user']['bearer_token'] ?? null; //!
        $_SESSION['username']      = $result['user']['username'] ?? null;
        $_SESSION['email_user']= $email;
        $_SESSION['id_empleado']      = $result['user']['id_empleado'] ?? [];
        $_SESSION['id_departamento']      = $result['user']['id_departamento'] ?? [];
        $_SESSION['id_user']      = $result['user']['id_user'] ?? [];
        $_SESSION['is_superuser']      = $result['user']['is_superuser'] ?? [];
        $_SESSION['permisoadministrativo']      = $result['user']['permisos']['apiadministrativo']['tipo'] ?? [];
        $_SESSION['permisogdt']      = $result['user']['permisos']['apigdt']['rol'] ?? [];
        $_SESSION['tipo_entidad']      = $result['user']['tipo_entidad'] ?? [];
        $_SESSION['modulos']      = $result['user']['modulos'] ?? [];
        $_SESSION['id_estacion'] = $result['user']['id_estacion'] ?? [];
        // Calculas UNA sola vez

        $deptosAsignados = TicketService::isCoordinador()['body']['resultado'] ?? [];

        if (!is_array($deptosAsignados)) {
            $deptosAsignados = [];
        }

        $_SESSION['deptos_coordinador'] = $deptosAsignados;
        $_SESSION['es_coordinador'] = !empty($deptosAsignados);
        

        



        Logger::module("AuthService", "Datos obtenidos al loguear ", $result);

        $this->json($result);
    }

    public function forget()
    {

        $this->validateMethod('POST');
        $data = $this->getJsonInput();

        $email = trim($data['email'] ?? '');

        if (empty($email)) {
            $this->error("Correo electronico es obligatorio");
        }

        $authService = $this->authService;

        $result = $authService->forget($data);

        if (!$result['success']) {
            return $this->error($result['message'] ?? "Error desconocido");
        }

        Logger::module("Auth forget", "Datos obtenidos al solicitar recuperacion del correo: " . $email, $result);
        $this->json($result);
    }

    public function restart()
    {
        $this->validateMethod('POST');
        $data = $this->getJsonInput();

        $pwd = trim($data['pwd'] ?? '');
        $pwd2 = trim($data['pwd2'] ?? '');

        if (empty($pwd) || empty($pwd2)) {
            $this->error("Constrasenas son obligatorio");
        }

        $result = $this->authService->restart($data);

        $this->json($result);
    }

    public function login()
    {
        $this->validateMethod('POST');
        $datos = $this->getJsonInput();
        $response = $this->authService->login($datos);
        $_SESSION['bearer_token'] = $response['body']['resultado']['user']['bearer_token'] ?? null;
        $_SESSION['username']      = $response['body']['resultado']['user']['username'] ?? null;
        $_SESSION['id_empleado']      = $response['body']['resultado']['user']['id_empleado'] ?? [];
        $_SESSION['id_user']      = $response['body']['resultado']['user']['id_user'] ?? [];
        $_SESSION['id_superuser']      = $response['body']['resultado']['user']['id_superuser'] ?? [];
        $_SESSION['permisoadministrativo']      = $response['body']['resultado']['user']['permisos']['apiadministrativo']['tipo'] ?? [];
        $_SESSION['permisogdt']      = $response['body']['resultado']['user']['permisos']['apigdt']['rol'] ?? [];
        $_SESSION['tipo_entidad']      = $response['body']['resultado']['user']['tipo_entidad'] ?? [];
        $_SESSION['modulos']      = $response['body']['resultado']['user']['modulos'] ?? [];
        Logger::module("AuthService", "Datos obtenidos al loguear ", $response);
        $this->json($response);
    }

    public function logout()
    {
        $this->validateMethod('GET');
        if (!isset($_SESSION['bearer_token'])) {
            return $this->error($result['message'] ?? "No hay sesion activa");
        }
        // $result = $this->authService->logout($_SESSION['bearer_token']);
        $result = $this->authService->logOut();


        Logger::module("AuthService", "Datos obtenidos al cerrar sesion: ", $result);

        session_unset();
        session_destroy();
        header("Location:" . Config::get('app.base_url') . "/");

        exit;
    }
}


/* class AuthController extends BaseController
{

    private $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function authenticate()
    {

        $this->validateMethod('POST');

        $data = $this->getJsonInput();

        $email = trim($data['email'] ?? '');

        $password = trim($data['pwd'] ?? '');

        if (empty($email) || empty($password)) {
            $this->error("Todos los campos son obligatorios");
        }

        $authService = $this->authService;

        $result = $authService->authenticate($data);
        if (!$result['success']) {
            return $this->error($result['message'] ?? "Error desconocido");
        }
        $_SESSION['bearer_token'] = $result['result']['bearer_token'] ?? null;
        $_SESSION['id_user'] = $result['result']['id_empleado'] ?? null;
        $_SESSION['username'] = $result['result']['id_empleado'] ?? null;
        $_SESSION['is_superuser'] = $result['result']['is_superuser'] ?? null;
        $_SESSION['id_sucursal'] = $result['result']['id_sucursal'] ?? null;
        $_SESSION['tipo_entidad'] = $result['result']['tipo_entidad'] ?? null;
        $_SESSION['id_departamento'] = $result['result']['id_departamento'] ?? null;
        $_SESSION['id_estacion'] = $result['result']['id_estacion'] ?? null;
        $_SESSION['id_tipo_entidad'] = $result['result']['id_tipo_entidad'] ?? null;
        $_SESSION['modulos'] = $result['result']['modulos'] ?? null;
        
        Logger::module("AuthService", "Datos obtenidos al loguear ", $result);

        $this->json($result);
    }

    public function logout(){
        $this->validateMethod('GET');
        if(!isset($_SESSION['bearer_token'])){
            return $this->error($result['message'] ?? "No hay sesion activa");
        }
        // $result = $this->authService->logout($_SESSION['bearer_token']);
        $result = $this->authService->logOut();
        
       
        Logger::module("AuthService", "Datos obtenidos al cerrar sesion: ", $result);

        session_unset();
        session_destroy();
        header("Location:".Config::get('app.base_url')."/");
        
        exit;


    }



    
}
 */