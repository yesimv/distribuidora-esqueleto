<?php

namespace App\Core;

/**
 * ==============================================================
 * ErrorHandler Global
 * Proyecto: MasterFuel Connect
 * Autor: Erick Retes
 * ==============================================================
 */

class ErrorHandler
{
    public static function register($debug = false)
    {
        set_error_handler(function ($errno, $errstr, $errfile, $errline) use ($debug) {

            Logger::php("PHP Error: $errstr", [
                "file" => $errfile,
                "line" => $errline,
                "type" => $errno
            ]);

            if ($debug) {
                echo "<pre>$errstr en $errfile línea $errline</pre>";
            }
        });

        set_exception_handler(function ($exception) use ($debug) {

            Logger::php("Uncaught Exception: " . $exception->getMessage(), [
                "file" => $exception->getFile(),
                "line" => $exception->getLine()
            ]);

            if ($debug) {
                echo "<pre>" . $exception->getMessage() . "</pre>";
            }
        });
    }
}
