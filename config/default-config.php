<?php

// MySQL database configuration
$connectionOptions = [
    'driver' => 'pdo_mysql',
    'host' => 'localhost',
    'user' => 'root',
    'password' => '',
    'dbname' => 'newsticker',
];

// Application/Doctrine configuration
$applicationOptions = [
    'debug_mode' => true, // in production environment false
    'entity_dir' => dirname(__DIR__) . '/src/Entities',
];
