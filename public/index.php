<?php

require_once __DIR__ . '/../vendor/autoload.php';
define('ROOT', dirname(__DIR__));

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

use App\Core\Config;
Config::load();

// ===================================
// CONFIGURACIÓN DE ENTORNO
// ===================================

$env   = Config::get('app.env') ?? 'production';
$debug = Config::get('app.debug');

// Configuración de errores según entorno
if ($debug) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    error_reporting(E_ALL);
}

// ===================================

session_start();

// Init del sistema
use App\Core\Init;
Init::run();

// Router
use App\Core\Router;

$router = new Router();
$router->run();
