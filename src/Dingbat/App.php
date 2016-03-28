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
     * @var App
     */
    protected static $instance;

    /**
     * @var \Slim\App
     */
    protected $slim;

    /**
     * @param string $rootDirectory Root of application (normally where the index.html is found)
     * @param array  $config        configuration of application
     */
    protected function __construct($rootDirectory, array $config = [])
    {
        // add route directory to $config
        $config['rootDirectory'] = $rootDirectory;

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
     * @param string $projectRoot path to root path of project
     * @param array $config
     * @return App
     * @throws \InvalidArgumentException
     */
    public static function instance($projectRoot = null, array $config = [])
    {
        if (!(self::$instance instanceof App))
        {
            if (is_null($projectRoot))
            {
                throw new \InvalidArgumentException('At first call of Dingbat::instance() is the $projectPath-parameter required');
            }

            self::$instance = new static($projectRoot, $config);
        }

        return self::$instance;
    }

    /**
     * @return Dotor
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @return \Slim\App
     */
    public function getSlim()
    {
        return $this->slim;
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