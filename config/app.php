<?php

/**
 * Configuración base de la aplicación
 */
return [
    'env' => $_ENV['APP_ENV'] ?? 'production',
    'debug' => $_ENV['APP_DEBUG'] === 'true',
    'url' => $_ENV['APP_URL'] ?? '',
    'base_url' => $_ENV['BASE_URL'] ?? ''
];