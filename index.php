<?php

// load composers autoloader
require __DIR__ . '/vendor/autoload.php';

// load config
require __DIR__ . '/config.php';

$config = [
    'database' => [
        'host'     => DBHOST,
        'username' => DBUSER,
        'password' => DBPASS,
        'name'     => DBNAME,
    ],
    'debugging' => true,
];

\Selleck\Todo::app(__DIR__, $config)->run();