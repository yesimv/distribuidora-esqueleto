<?php

namespace App\Core;

/**
 * BaseController
 *
 * Clase base que deben extender todos los controladores.
 * Centraliza:
 * - Respuestas JSON
 * - Validación de método HTTP
 * - Lectura de input JSON
 */
class BaseController
{
    /**
     * Devuelve respuesta JSON estructurada
     */
    protected function json($data = [], int $statusCode = 200)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }

    /**
     * Obtiene el body JSON enviado por fetch
     */
    protected function getJsonInput(): array
    {
        $input = json_decode(file_get_contents("php://input"), true);

        return is_array($input) ? $input : [];
    }

    /**
     * Valida método HTTP
     */
    protected function validateMethod(string $method)
    {
        if ($_SERVER['REQUEST_METHOD'] !== strtoupper($method)) {
            $this->json([
                "success" => false,
                "message" => "Método no permitido"
            ], 405);
        }
    }

    /**
     * Respuesta de éxito estándar
     */
    protected function success($data = [], string $message = "Operación exitosa")
    {
        $this->json([
            "success" => true,
            "message" => $message,
            "data" => $data
        ]);
    }

    /**
     * Respuesta de error estándar
     */
    protected function error(string $message = "Error", int $statusCode = 400)
    {
        $this->json([
            "success" => false,
            "message" => $message
        ], $statusCode);
    }

    protected function view(string $view, array $data = [], $layout = 'app')
    {
        extract($data);

        //archivo js
        $moduloScript = $view;

        // 1️⃣ Capturar vista
        ob_start();
        require ROOT . "/app/Views/{$view}.php";
        $content = ob_get_clean();

        if ($layout === null) {
            echo $content;
            return;
        }

        require ROOT . "/app/Views/layout/app.php";
    }

    protected function redirect(string $path)
    {
        $basePath = \App\Core\Config::get('app.base_url');
        header("Location: " . $basePath . $path);
        exit;
    }
}
