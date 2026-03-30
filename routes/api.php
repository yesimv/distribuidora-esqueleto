<?php

use App\Controllers\api\AuthController;
use App\Controllers\api\AnalisisController;
use App\Controllers\api\TicketController;

return [
    
    'POST' => [

        '/login' => [
            'controller' => [AuthController::class, 'authenticate'],
            'middleware' => ['guest']
        ],
        
        '/analisis' => [
            'controller' => [AnalisisController::class, 'index'],
            'middleware' => ['auth']
        ],
        '/get-analisis' => [
            'controller' => [AnalisisController::class, 'getAnalisis'],
            'middleware' => ['auth']
        ],
        '/ticket-fecha' => [
            'controller' => [TicketController::class, 'date'],
            'middleware' => ['auth']
        ],
        
        '/new-ticket' => [
            'controller' => [TicketController::class, 'create'],
            'middleware' => ['auth']
        ],
        '/new-analisis' => [
            'controller' => [TicketController::class, 'createAnalisis'],
            'middleware' => ['auth']
        ],
        '/get-ticket' => [
            'controller' => [TicketController::class, 'getTicket'],
            'middleware' => ['auth']
        ],
        '/edit-ticket' => [
            'controller' => [TicketController::class, 'edit'],
            'middleware' => ['auth']
        ],
        '/borrar-ticket' => [
            'controller' => [TicketController::class, 'borrar'],
            'middleware' => ['auth']
        ],
        '/asignar-ticket' => [
            'controller' => [TicketController::class, 'asignar'],
            'middleware' => ['auth']
        ],
        '/actualizar-estatus'=> [
            'controller' => [TicketController::class, 'cambiarEstatus'],
            'middleware' => ['auth']
        ],
        '/analisis-fecha' => [
            'controller' => [AnalisisController::class, 'date'],
            'middleware' => ['auth']
        ],
        
        

    ],
    'GET' => [
        '/tickets' => [
            'controller' => [TicketController::class, 'index'],
            'middleware' => ['auth']
        ],
        '/is-coordinador' => [
            'controller' => [TicketController::class, 'isCoordinador'],
            'middleware' => ['auth']
        ],
        
        '/analisis' => [
            'controller' => [AnalisisController::class, 'index'],
            'middleware' => ['auth']
        ],
        '/logout' => [
            'controller' => [AuthController::class, 'logOut'],
            'middleware' => ['auth']
        ],
        '/get-form-data' => [
            'controller' => [TicketController::class, 'formData'],
            'middleware' => ['auth']
        ],
        '/get-resolucion' => [
            'controller' => [AnalisisController::class, 'formData'],
            'middleware' => ['auth']
        ],
    ]


];

?>