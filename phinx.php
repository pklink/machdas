<?php

$config = require __DIR__ . '/config.php';

return [
    'paths' => [
        'migrations' => __DIR__ . '/db/migrations',
        'seeds'      => __DIR__ . '/db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_database'        => 'machdas',
        'dev' => [
            'adapter' => $config['db']['driver'],
            'host'    => $config['db']['host'],
            'name'    => $config['db']['database'],
            'user'    => $config['db']['username'],
            'pass'    => $config['db']['password'],
            'charset' => $config['db']['charset']
        ],
        'prod' => [
            'adapter' => $config['db']['driver'],
            'host'    => $config['db']['host'],
            'name'    => $config['db']['database'],
            'user'    => $config['db']['username'],
            'pass'    => $config['db']['password'],
            'charset' => $config['db']['charset']
        ]
    ]
];