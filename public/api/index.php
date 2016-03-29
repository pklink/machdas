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
    /* @var \Slim\App $this */
    $this->post('', \Dingbat\Action\Card\Create::class);
    $this->get('', \Dingbat\Action\Card\GetAll::class);
    $this->get('/{id:\d+}', \Dingbat\Action\Card\GetOne::class);
    $this->put('/{id:\d+}', \Dingbat\Action\Card\Update::class);
    $this->delete('/{id:\d+}', \Dingbat\Action\Card\Delete::class);
});

$app->group('/tasks', function() {
    /* @var \Slim\App $this */
    $this->post('', \Dingbat\Action\Task\Create::class);
    $this->get('', \Dingbat\Action\Task\GetAll::class);
    $this->get('/{id:\d+}', \Dingbat\Action\Task\GetOne::class);
    $this->put('/{id:\d+}', \Dingbat\Action\Task\Update::class);
    $this->delete('/{id:\d+}', \Dingbat\Action\Task\Delete::class);
});


// start app
$app->run();