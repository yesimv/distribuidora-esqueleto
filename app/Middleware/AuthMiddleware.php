<?php

namespace App\Middleware;

use App\Core\Config;
/**
 * Middleware de autenticación
 *
 * Se ejecuta antes de entrar a cualquier módulo protegido.
 * Valida si existe sesión activa.
 */

class AuthMiddleware {
    /**
     * Verifica si el usuario está autenticado.
     * Si no lo está, lo redirige al login.
     */
    public static function handle(){
       $base = Config::get('app.base_url');
       //echo  $_SESSION['bearer_token'];
       if (empty($_SESSION['bearer_token']) || !is_string($_SESSION['bearer_token'])) {
            
            header("Location: " . $base . "/login");
            exit;
        }

    }

}