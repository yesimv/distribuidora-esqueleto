<?php

namespace App\Services;

use App\Core\Logger;

class ApiClient
{
    private string $baseUrl;
    private array $headers = [];

    public function __construct(string $api)
    {
        $this->baseUrl = match ($api) {
            'auth' => $_ENV['API_AUTH_URL'],
            'gdt'  => $_ENV['API_GDT_URL'],
            'ticket'  => $_ENV['API_TICKET_URL'],
            'administrativo'  => $_ENV['API_ADMINISTRATIVO_URL'],
            default => throw new \Exception("API no definida")
        };

        $this->headers = [
            "Content-Type: application/x-www-form-urlencoded"
        ];

        // 🔥 Agregamos Bearer automáticamente
        if (!empty($_SESSION['bearer_token'])) {
            $this->headers[] = "Authorization: Bearer " . $_SESSION['bearer_token'];
        }
    }

    public function request(string $method, string $endpoint, array $data = [], bool $formData = true)
    {
        $url = rtrim($this->baseUrl, '/') . '/' . ltrim($endpoint, '/');

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST  => strtoupper($method),
            CURLOPT_POSTFIELDS     => $formData ? http_build_query($data) : json_encode($data),
            CURLOPT_HTTPHEADER     => $this->headers,
            CURLOPT_TIMEOUT        => 30,
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {

            Logger::php("Error cURL", [
                "error" => curl_error($ch),
                "endpoint" => $endpoint
            ]);

            curl_close($ch);
            throw new \Exception("Error al conectar con API");
        }

        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        Logger::php("Respuesta API", [
            "endpoint" => $endpoint,
            "status" => $statusCode,
            "response" => $response
        ]);

        // 🔐 Si token expiró
        if ($statusCode === 401) {

            Logger::php("Token expirado o no autorizado", [
                "endpoint" => $endpoint
            ]);

            // Limpiar sesión
            session_unset();
            session_destroy();

            throw new \Exception("TOKEN_EXPIRED");
        }

        return [
            "status" => $statusCode,
            "body"   => json_decode($response, true)
        ];
    }
}


/* 
class ApiClient
{

    public function __construct() {}
    public function request($peticion, $ruta, $data=[],$header2=[])
    {
        $header1=array('Content-Type: application/json');
        $curl = curl_init();

        $url = $_ENV["API_AUTH_URL"]. $ruta;
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $peticion,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array_merge($header1,$header2)
            
        ));


        $response = curl_exec($curl);


        curl_close($curl);
        return json_decode($response,true);
    }
    
    
}
 */