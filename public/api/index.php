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
$container['db'] = function($container) {
    $capsule = new \Illuminate\Database\Capsule\Manager();
    $capsule->addConnection($container['settings']['db']);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();
    return $capsule;
};

// add error handler
$container['notFoundHandler'] = function() {
    /** @noinspection PhpUnusedParameterInspection */
    return function($request, \Slim\Http\Response $response) {
        return $response
            ->withStatus(404)
            ->withHeader('Content-Type', 'text/html')
            ->withJson(['message' => 'Not Found']);
    };
};

$container['notAllowedHandler'] = function() {
    /** @noinspection PhpUnusedParameterInspection */
    return function($request, \Slim\Http\Response $response, array $methods) {
        return $response
            ->withStatus(405)
            ->withHeader('Allow', implode(', ', $methods))
            ->withJson(['message' => 'Method must be one of: ' . implode(', ', $methods)]);
    };
};

$container['errorHandler'] = function($container) {
    /** @noinspection PhpUnusedParameterInspection */
    return function($request, \Slim\Http\Response $response, Exception $exception) use ($container) {
        $payload = ['message' => 'Something went wrong!'];

        // if debugging enabled add trace to response
        if ($container['settings']['displayErrorDetails'] === true) {
            $payload['trace'] = $exception->getTrace();
        }

        return $response
            ->withStatus(500)
            ->withJson($payload);
    };
};

// create app
$app = new \Slim\App($container);

// routing
$app->group('/cards', function() {
    /* @var \Slim\App $this */
    $this->post('', \Machdas\Action\Card\Create::class);
    $this->post('/{id:\d+}/tasks', \Machdas\Action\Card\CreateTask::class);
    $this->get('', \Machdas\Action\Card\GetAll::class);
    $this->get('/{id:\d+}', \Machdas\Action\Card\GetOne::class);
    $this->get('/{id:\d+}/tasks', \Machdas\Action\Card\GetAllTasks::class);
    $this->put('/{id:\d+}', \Machdas\Action\Card\Update::class);
    $this->delete('/{id:\d+}', \Machdas\Action\Card\Delete::class);
    $this->get('/tasks/count', \Machdas\Action\Card\CountTasks::class);
});

$app->group('/tasks', function() {
    /* @var \Slim\App $this */
    $this->get('/{id:\d+}', \Machdas\Action\Task\GetOne::class);
    $this->put('/{id:\d+}', \Machdas\Action\Task\Update::class);
    $this->delete('/{id:\d+}', \Machdas\Action\Task\Delete::class);
});

// initialize eloquent
$container->get('db');

// start app
$app->run();
