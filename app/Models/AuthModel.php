<?php

namespace App\Models;

use App\Services\ApiClient;
use App\Core\Logger;
use Exception;

class AuthModel
{

    private $api;

    public function __construct()
    {
        $this->api = new ApiClient('auth');
    }

    public function authenticate(array $data)
    {

        try {

            $response = $this->api->request("POST", 'auth/login', $data);

            return $response;
        } catch (\Exception $e) {

            Logger::module("AuthModel", "Error al obtener datos de la Api en la ruta auth/login, error: " . $e->getMessage());

            throw new \Exception("Error comunicando con la API auth");
        }
    }

    public function forget(array $data)
    {
        try {

            $response = $this->api->request("POST", 'auth/olvide', $data);

            return $response;

        } catch (\Exception $e) {

            Logger::module("AuthModel", "Error al obtener datos de la Api en la ruta auth/olvide, error: " . $e->getMessage());

            throw new \Exception("Error comunicando con la API auth");
        }
    }

    public function restart(array $data){
        try {

            $token = $data['token'];
            $datos = [
                'pwd'=>$data['pwd'],
                'pwd2'=>$data['pwd2']
            ];

            $response = $this->api->request("POST","auth/restablecer?token=".$token,$datos);

            return $response;
            
        } catch (\Exception $e) {

            Logger::module("AuthModel", "Error al obtener datos de la Api en la ruta auth/restablecer?token, error: " . $e->getMessage());

            throw new \Exception("Error comunicando con la API auth");
        }
    }

    public function login(array $data){
        $response = $this->api->request('POST','auth/login',$data);
        return $response;
    }
    public function logOut()
    {
        try{
            
            $response = $this->api->request("GET", 'auth/logout',[],false);
            return $response;
        } catch(\Exception $e){
            Logger::module("AuthModel", "Error al obtener datos de la Api en la ruta auth/login, error: " . $e->getMessage());
        }


    }
    
}


/* class AuthModel
{

    private $api;

    public function __construct()
    {
        $this->api = new ApiClient('auth');
    }

    public function authenticate(array $data)
    {
        try{
            $response = $this->api->request("POST", 'auth/login', $data,[]);
            return $response;
        } catch(\Exception $e){
            Logger::module("AuthModel", "Error al obtener datos de la Api en la ruta auth/login, error: " . $e->getMessage());
        }


    }
    public function logOut()
    {
        try{
            $header=
            array(
                "Authorization: Bearer {$_SESSION['bearer_token']}"
            );
            $response = $this->api->request("GET", 'auth/logout',[],$header);
            return $response;
        } catch(\Exception $e){
            Logger::module("AuthModel", "Error al obtener datos de la Api en la ruta auth/login, error: " . $e->getMessage());
        }


    }

    
}
 */