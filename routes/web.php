<?php

use App\Controllers\web\TicketController;
use App\Controllers\web\HomeController;
use App\Controllers\web\AuthController;
use App\Controllers\web\ComponentController;
use App\Controllers\web\SistemaController;
use App\Controllers\web\AnalisisController;

return [

    'GET' => [

        '/' => [
            'controller' => [HomeController::class, 'index'],
            'middleware' => ['auth']
        ],

        '/login/logout' => [
            'controller' => [AuthController::class, 'logOut'],
            'middleware' => ['auth']
        ],

        '/login' => [
            'controller' => [AuthController::class, 'index'],
            'middleware' => ['guest']
        ],

        
        '/ticket-create' => [
            'controller' => [TicketController::class, 'create'],
            'middleware' => ['auth']
        ],
        '/tickets' => [
            'controller' => [TicketController::class, 'index'],
            'middleware' => ['auth']
        ],
        '/sistema-ticket' => [
            'controller' => [SistemaController::class, 'index'],
            'middleware' => ['auth']
        ],
        '/analisis' => [
            'controller' => [AnalisisController::class, 'index'],
            'middleware' => ['auth']
        ],
        '/analisis-create' => [
            'controller' => [AnalisisController::class, 'create'],
            'middleware' => ['auth']
        ],
        '/form-example' => [
            'controller' => [ComponentController::class, 'form'],
            'middleware' => ['auth']
        ],
        '/table-example' => [
            'controller' => [ComponentController::class, 'table'],
            'middleware' => ['auth']
        ],
        '/blank-example' => [
            'controller' => [ComponentController::class, 'blank'],
            'middleware' => ['auth']
        ],
        '/profile-example' => [
            'controller' => [ComponentController::class, 'profile'],
            'middleware' => ['auth']
        ],
        '/ticket-editar' => [
            'controller' => [TicketController::class, 'editar'],
            'middleware' => ['auth']
        ],
        
    ],


];
