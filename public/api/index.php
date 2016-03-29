<?php

// load composers autoloader
require __DIR__ . '/../../vendor/autoload.php';

// load config
$config = require __DIR__ . '/../../config.php';

// create DI-container
$container = new \Slim\Container([
    'settings' => [
        'displayErrorDetails' => $config['debugging'],
        'db'                  => $config['db']
    ]
]);

// prepare eloquent
$container['db'] = function ($container) {
    $capsule = new \Illuminate\Database\Capsule\Manager();
    $capsule->addConnection($container['settings']['db']);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();
    return $capsule;
};

// create app
$app = new \Slim\App($container);

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

// initialize eloquent
$container->get('db');

// start app
$app->run();