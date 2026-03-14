<?php

namespace App\Core;

/**
 * Clase Config
 *
 * Se encarga de:
 * - Cargar los archivos de configuración (config/app.php, etc.)
 * - Guardarlos en memoria
 * - Permitir acceder a ellos usando notación con punto (ej: app.env)
 */

class Config
{
    /**
     * Aquí se almacenará toda la configuración cargada.
     * Es static porque pertenece a la clase, no a una instancia.
     * Ejemplo de cómo queda internamente:
     *
     * [
     *   'app' => [
     *       'env' => 'local',
     *       'debug' => true
     *   ]
     * ]
     */
    protected static $config = [];

    /**
     * Carga los archivos de configuración.
     * Este método debe llamarse una sola vez en index.php
     */
    public static function load()
    {
        // Carga el archivo config/app.php
        // Ese archivo devuelve un array
        // Lo guardamos dentro de self::$config['app']
        self::$config['app'] = require ROOT . '/config/app.php';
    }

    /**
     * Obtiene un valor de configuración usando notación con punto.
     *
     * Ejemplo:
     * Config::get('app.env');
     *
     * Eso buscará:
     * self::$config['app']['env']
     *
     * @param string $key
     * @return mixed|null
     */
    public static function get($key)
    {
        // Divide la clave por el punto
        // 'app.env' → ['app', 'env']
        $keys = explode('.', $key);

        // Empezamos desde el array completo
        $value = self::$config;

        // Recorremos cada segmento
        foreach ($keys as $segment) {

            // Si no existe la clave, retornamos null
            // Esto evita errores tipo "Undefined index"
            if (!isset($value[$segment])) {
                return null;
            }

            // Bajamos un nivel en el array
            // Primero: $config['app']
            // Luego: $config['app']['env']
            $value = $value[$segment];
        }

        // Retornamos el valor final encontrado
        return $value;
    }
}
