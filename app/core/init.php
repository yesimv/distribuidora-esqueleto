<?php

namespace App\Core;
use App\Core\Logger;
use App\Core\ErrorHandler;
use App\Core\Config;
/**
 * ==============================================================
 * Inicializacion del sistema
 * Proyecto: MasterFuel Connect
 * Autor: Erick Retes
 * ==============================================================
 *
 * Este archivo inicializa los servicios centrales del sistema:
 * - Logger
 * - Manejo global de errores
 *
 * Se ejecuta una sola vez desde index.php
 */

class Init
{
    public static function run()
    {
        date_default_timezone_set('America/Hermosillo');

        Logger::init();
        ErrorHandler::register(Config::get('app.debug'));
    }
}
