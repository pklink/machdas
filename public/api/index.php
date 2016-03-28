<?php

// load composers autoloader
require __DIR__ . '/../../vendor/autoload.php';

// load config
$config = require __DIR__ . '/../../config.php';

// create app
$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => $config['debugging']
    ]
]);

// prepare database
$capsule = new \Illuminate\Database\Capsule\Manager();
$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => $config['database']['host'],
    'database'  => $config['database']['name'],
    'username'  => $config['database']['username'],
    'password'  => $config['database']['password'],
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

$capsule->bootEloquent();

// routing
$app->post('/cards', \Dingbat\Action\Card\Create::class . ':run');
$app->get('/cards', \Dingbat\Action\Card\GetAll::class . ':run');
$app->get('/cards/{id}', \Dingbat\Action\Card\GetOne::class . ':run');
$app->delete('/cards/{id}', \Dingbat\Action\Card\Delete::class . ':run');
$app->put('/cards/{id}', \Dingbat\Action\Card\Update::class . ':run');

$app->post('/tasks', \Dingbat\Action\Task\Create::class . ':run');
$app->get('/tasks/{id}', \Dingbat\Action\Task\GetOne::class . ':run');
$app->get('/tasks', \Dingbat\Action\Task\GetAll::class . ':run');
$app->put('/tasks/{id}', \Dingbat\Action\Task\Update::class . ':run');
$app->delete('/tasks/{id}', \Dingbat\Action\Task\Delete::class . ':run');

// start app
$app->run();