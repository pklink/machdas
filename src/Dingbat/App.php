<?php


namespace Dingbat;

use Dotor\Dotor;
use Illuminate\Database\Capsule\Manager;

/**
 * Class App
 *
 * @category Core
 * @package  Dingbat
 * @author   Pierre Klink <dev@klinks.info>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://github.com/pklink/Dingbat
 */
class App
{

    /**
     * @var \Dotor\Dotor
     */
    protected $config;

    /**
     * @var \Slim\App
     */
    protected $slim;

    /**
     * @param array  $config configuration of application
     */
    public function __construct(array $config = [])
    {
        // create config
        $this->config = new Dotor($config);

        // create app
        $this->slim          = new \Slim\App([
            'settings' => [
                'displayErrorDetails' => true
            ]
        ]);

        $this->prepareDatabase();
        $this->setRoutes();
    }

    /**
     * @return void
     */
    protected function prepareDatabase()
    {
        $capsule = new Manager();
        $capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => $this->config->get('database.host'),
            'database'  => $this->config->get('database.name'),
            'username'  => $this->config->get('database.username'),
            'password'  => $this->config->get('database.password'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);

        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }

    /**
     * @return void
     */
    public function run()
    {
        $this->slim->run();
    }

    /**
     * @return void
     */
    protected function setRoutes()
    {
        // cards
        $this->slim->post('/cards', Action\Card\Create::class . ':run');
        $this->slim->get('/cards', Action\Card\GetAll::class . ':run');
        $this->slim->get('/cards/{slug}', Action\Card\GetOne::class . ':run');
        $this->slim->delete('/cards/{slug}', Action\Card\Delete::class . ':run');
        $this->slim->put('/cards/{slug}', Action\Card\Update::class . ':run');

        // tasks
        $this->slim->post('/tasks', Action\Task\Create::class . ':run');
        $this->slim->get('/tasks/{id}', Action\Task\GetOne::class . ':run');
        $this->slim->get('/tasks', Action\Task\GetAll::class . ':run');
        $this->slim->put('/tasks/{id}', Action\Task\Update::class . ':run');
        $this->slim->delete('/tasks/{id}', Action\Task\Delete::class . ':run');
    }

}