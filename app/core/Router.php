<?php

namespace App\Core;

use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;
use App\Core\Config;
use App\Core\Logger;

class Router
{
    public function run()
    {

        $method = $_SERVER['REQUEST_METHOD'];

        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


        if (stripos($uri, 'Controllers/controllersold/apiController.php') !== false) {
            require ROOT . '/app/Controllers/controllersold/apiController.php';
            exit;
        }

        // 🔹 Primero quitar basePath
        $basePath = Config::get('app.base_url');

        if ($basePath && strpos($uri, $basePath) === 0) {
            $uri = substr($uri, strlen($basePath));
        }

        //normalizamos url
        if ($uri === '') {
            $uri = '/';
        }

        //detectamos si es api
        $isApi = str_starts_with($uri, '/api');

        if ($isApi) {
            //Logger::module("Router", "es Api: " . $uri);
            $uri = substr($uri, 4); // elimina '/api' despues de mandarlo por js en el request ('/api/login/autenticate') por ejemplo
            if ($uri === '') {
                $uri = '/';
            }
        }

        $routesFile = $isApi
            ? ROOT . '/routes/api.php'
            : ROOT . '/routes/web.php';

        $routes = require $routesFile;

        if (!isset($routes[$method][$uri])) {
            http_response_code(404);
            Logger::module("Router", "Ruta ingresada inexistente, ruta: " . $uri);
            if(!isset($_SESSION['bearer_token'])){
                require ROOT . "/app/Views/auth/signin.php";
            return;
            }
            require ROOT . "/app/Views/errors/404.php";
            return;
        }

        $route = $routes[$method][$uri];

        // 🔐 Ejecutar middleware
        if (!empty($route['middleware'])) {

            foreach ($route['middleware'] as $middleware) {

                match ($middleware) {
                    'auth'  => AuthMiddleware::handle(),
                    'guest' => GuestMiddleware::handle(),
                    default => null
                };
            }
        }

        [$controllerClass, $methodName] = $route['controller'];

        try {

            $controller = new $controllerClass();
            $controller->$methodName();
        } catch (\Exception $e) {

            if ($e->getMessage() === "TOKEN_EXPIRED") {
                header("Location: /login");
                exit;
            }

            \App\Core\Logger::php("Excepción no controlada", [
                "error" => $e->getMessage()
            ]);

            http_response_code(500);
            echo "Error interno del servidor";
        }
    }
}
