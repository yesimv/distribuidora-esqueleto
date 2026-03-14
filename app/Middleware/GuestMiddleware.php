<?php

namespace App\Middleware;
use App\Core\Config;

class GuestMiddleware
{
    public static function handle()
    {
        $ruta = Config::get("app.base_url");
        if (!empty($_SESSION['bearer_token'])) {
            header("Location:".$ruta."/");
            exit;
        }
    }
}
