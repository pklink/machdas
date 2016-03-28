<?php


namespace Dingbat;

use Codeception\Step\Action;
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
     * @var Request
     */
    protected $request;

    /**
     * @var \Silex\Application
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
        //$this->slim['debug'] = $this->config->getBool('debugging', false);

        // set instance of Request
        /*
        $this->slim->before(function (Request $request) {
            if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
                $data = json_decode($request->getContent(), true);
                $request->request->replace(is_array($data) ? $data : array());
            }

            $this->request = $request;
        });
        */

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
     * @return \Symfony\Component\HttpFoundation\Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return Application
     */
    public function getSlim()
    {
        return $this->slim;
    }

    /**
     * @param Action $action
     * @return Action
     */
    public function prepareAction(Action $action)
    {
        $action->setRequest($this->getRequest());
        return $action;
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
        // layout
        /*
        $this->slim->get('/', function() {
            ob_start();

            $appName = $this->config->get('name', 'Dingbat');
            $locale  = $this->slim['translator'];

            require(__DIR__ . '/../../views/layout.php');
            return ob_get_clean();
        });
        */

        // cards
        $this->slim->post('/cards', \Dingbat\Action\Card\Create::class . ':run');
        $this->slim->get('/cards', \Dingbat\Action\Card\GetAll::class . ':run');
        $this->slim->get('/cards/{slug}', \Dingbat\Action\Card\GetOne::class . ':run');
        $this->slim->delete('/cards/{slug}', \Dingbat\Action\Card\Delete::class . ':run');
        $this->slim->put('/cards/{slug}', \Dingbat\Action\Card\Update::class . ':run');

        // tasks
        $this->slim->post('/tasks', \Dingbat\Action\Task\Create::class . ':run');
        $this->slim->get('/tasks/{id}', \Dingbat\Action\Task\GetOne::class . ':run');
        $this->slim->get('/tasks', \Dingbat\Action\Task\GetAll::class . ':run');
        $this->slim->put('/tasks/{id}', \Dingbat\Action\Task\Update::class . ':run');
        $this->slim->delete('/tasks/{id}', \Dingbat\Action\Task\Delete::class . ':run');
    }

}