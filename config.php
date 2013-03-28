<?php

return [
    'database' => [
        'host'     => 'localhost',
        'username' => 'root',
        'password' => 'bitnami',
        'name'     => 'selleck',
    ],

    'minifier' => [
        'path'    => __DIR__ . '/js',
        'scripts' => [
            'vendor/custom.modernizr',
            'vendor/jquery-1.9.1.min',
            'vendor/jquery-ui-1.10.2.custom.min',
            'vendor/foundation',
            'vendor/json2-min',
            'vendor/underscore-min',
            'vendor/backbone-min',
            'vendor/backbone.layoutmanager',
            'Model/task',
            'Collection/tasks',
            'View/form',
            'View/task',
            'View/list',
            'View/footer',
            'View/sidebar',
            'View/app',
            'dingbat'
        ],
    ],

    'debugging' => false,
];
