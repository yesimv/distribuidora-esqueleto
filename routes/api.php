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
        '/ticket-fecha' => [
            'controller' => [TicketController::class, 'date'],
            'middleware' => ['auth']
        ],
        '/filtro-ticket-fecha' => [
            'controller' => [TicketController::class, 'dateFilter'],
            'middleware' => ['auth']
        ],
        
        

    ],
    'GET' => [
        '/tickets' => [
            'controller' => [TicketController::class, 'index'],
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
    ]


];

?>