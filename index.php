<?php

// load composers autoloader
require __DIR__ . '/vendor/autoload.php';

$config = [
    'database' => [
        'host'     => 'localhost',
        'username' => 'root',
        'password' => 'bitnami',
        'name'     => 'silextodo',
    ]
];

\Selleck\Todo::app(__DIR__, $config)->run();