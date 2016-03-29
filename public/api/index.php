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
$app->group('/cards', function() {
    $this->post('', \Dingbat\Action\Card\Create::class . ':run');
    $this->get('', \Dingbat\Action\Card\GetAll::class . ':run');
    $this->get('/{id:\d+}', \Dingbat\Action\Card\GetOne::class . ':run');
    $this->put('/{id:\d+}', \Dingbat\Action\Card\Update::class . ':run');
    $this->delete('/{id:\d+}', \Dingbat\Action\Card\Delete::class . ':run');
});

$app->group('/tasks', function() {
    $this->post('', \Dingbat\Action\Task\Create::class . ':run');
    $this->get('', \Dingbat\Action\Task\GetAll::class . ':run');
    $this->get('/{id:\d+}', \Dingbat\Action\Task\GetOne::class . ':run');
    $this->put('/{id:\d+}', \Dingbat\Action\Task\Update::class . ':run');
    $this->delete('/{id:\d+}', \Dingbat\Action\Task\Delete::class . ':run');
});


// start app
$app->run();