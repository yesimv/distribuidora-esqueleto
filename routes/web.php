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

        // '/forget'=>[
        //     'controller' => [AuthController::class, 'forget'],
        //     'middleware' => ['guest']
        // ],

        // '/restablecer'=>[
        //     'controller' => [AuthController::class, 'restart'],
        //     'middleware' => ['guest']
        // ],

        // '/new-pwd'=>[
        //     'controller' => [AuthController::class, 'restartPwd'],
        //     'middleware' => ['auth']
        // ],

        // '/perfil'=>[
        //     'controller' => [AuthController::class, 'perfil'],
        //     'middleware' => ['auth']
        // ],

        // '/vacaciones-solicitar'=>[
        //     'controller' => [VacacionesController::class, 'index'],
        //     'middleware' => ['auth']
        // ],

        // '/vacaciones-nomina'=>[
        //     'controller' => [VacacionesController::class, 'nomina'],
        //     'middleware' => ['auth']
        // ],

        // '/vacaciones-conta'=>[
        //     'controller' => [VacacionesController::class, 'contabilidad'],
        //     'middleware' => ['auth']
        // ],

    ],


];
