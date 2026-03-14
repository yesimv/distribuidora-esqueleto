<?php
namespace App\Core;

/**
 * ==============================================================
 *  Logger - Sistema Centralizado de Logs
 *  Proyecto: MasterFuel Connect
 *  Autor: Erick
 * ==============================================================
 *
 *  Este Logger permite:
 *  - Guardar errores de PHP
 *  - Guardar errores enviados desde JS
 *  - Guardar logs específicos por módulo
 *  - Separar logs por fecha automáticamente
 *  - Estructurar logs en formato JSON (fácil de analizar después)
 *
 *  Estructura generada:
 *
 *      /logs
 *          /php
 *          /js
 *          /modules
 *
 *  Cada archivo se genera por día:
 *      php-YYYY-MM-DD.log
 *      js-YYYY-MM-DD.log
 *      modulo-YYYY-MM-DD.log
 *
 *  Ventajas:
 *  - Fácil mantenimiento
 *  - Fácil auditoría
 *  - Escalable
 *  - Compatible con futuros visores de logs
 *
 */

class Logger
{
    /**
     * Ruta base donde se guardan los logs.
     * Se define dinámicamente al iniciar el sistema.
     */
    private static $basePath;

    /**
     * --------------------------------------------------------------
     * Inicializa el Logger
     * --------------------------------------------------------------
     *
     * - Define la ruta base de logs
     * - Crea carpetas si no existen
     *
     * Debe llamarse una sola vez en index.php
     */
    public static function init()
    {
        // dirname(__DIR__) apunta a la raíz del proyecto
        self::$basePath = ROOT . "/logs";

        // Creamos subcarpetas organizadas
        self::createDirectory(self::$basePath . "/php");
        self::createDirectory(self::$basePath . "/js");
        self::createDirectory(self::$basePath . "/modules");
    }

    /**
     * --------------------------------------------------------------
     * Crea una carpeta si no existe
     * --------------------------------------------------------------
     *
     * @param string $path Ruta absoluta
     */
    private static function createDirectory($path)
    {
        if (!is_dir($path)) {
            mkdir($path, 0755, true); // 0755 = permisos seguros
        }
    }

    /**
     * --------------------------------------------------------------
     * Obtiene la ruta completa del archivo de log
     * --------------------------------------------------------------
     *
     * @param string $type Tipo de log (php, js, module)
     * @param string|null $module Nombre del módulo (si aplica)
     *
     * @return string Ruta completa del archivo
     */
    private static function getFilePath($type, $module = null)
    {
        $date = date("Y-m-d"); // Cada día genera un archivo nuevo

        switch ($type) {

            // Logs generales del backend
            case "php":
                return self::$basePath . "/php/php-$date.log";

                // Logs enviados desde JavaScript
            case "js":
                return self::$basePath . "/js/js-$date.log";

                // Logs específicos por módulo
            case "module":
                return self::$basePath . "/modules/{$module}-$date.log";

                // En caso de que no se especifique tipo
            default:
                return self::$basePath . "/general-$date.log";
        }
    }

    /**
     * --------------------------------------------------------------
     * Método central que escribe en el archivo
     * --------------------------------------------------------------
     *
     * Este método:
     * - Construye el JSON del log
     * - Agrega información útil automáticamente
     * - Guarda en el archivo correspondiente
     *
     * @param string $type
     * @param string $message
     * @param array $context
     * @param string|null $module
     */
    private static function write($type, $message, $context = [], $module = null)
    {
        $file = self::getFilePath($type, $module);

        // Información estándar que SIEMPRE queremos guardar
        $log = [
            "timestamp" => date("Y-m-d H:i:s"),
            "level" => strtoupper($type),
            "user" => $_SESSION['username'] ?? "guest",
            "ip" => $_SERVER['HTTP_X_FORWARDED_FOR']
                ?? $_SERVER['REMOTE_ADDR']
                ?? "unknown",
            "url" => $_SERVER['REQUEST_URI'] ?? null,
            "message" => $message,
            "context" => $context
        ];

        // Guardamos como JSON por línea
        // JSON facilita análisis futuro o importación a base de datos
        file_put_contents(
            $file,
            json_encode($log, JSON_UNESCAPED_UNICODE) . PHP_EOL,
            FILE_APPEND
        );
    }

    /**
     * --------------------------------------------------------------
     * Log de errores PHP (Backend)
     * --------------------------------------------------------------
     *
     * Uso:
     * Logger::php("Error al conectar DB", ["codigo" => 500]);
     */
    public static function php($message, $context = [])
    {
        self::write("php", $message, $context);
    }

    /**
     * --------------------------------------------------------------
     * Log de errores JavaScript (Frontend)
     * --------------------------------------------------------------
     *
     * Se usa cuando JS envía errores al backend.
     */
    public static function js($message, $context = [])
    {
        self::write("js", $message, $context);
    }

    /**
     * --------------------------------------------------------------
     * Log específico por módulo
     * --------------------------------------------------------------
     *
     * Uso recomendado dentro de controladores:
     *
     * Logger::module("vacaciones", "Error al autorizar", [
     *     "id" => 15
     * ]);
     *
     * Esto crea:
     * /logs/modules/vacaciones-YYYY-MM-DD.log
     */
    public static function module($moduleName, $message, $context = [])
    {
        self::write("module", $message, $context, $moduleName);
    }

    
}
