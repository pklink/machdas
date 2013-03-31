<?php


namespace Dingbat;

use Dotor\Dotor;
use Silex\Application;
use Silex\Provider\UrlGeneratorServiceProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Phormium\DB;

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
    protected $silex;


    /**
     * Constructor
     *
     * @param string $rootDirectory Root of application (normally where the
     * index.html is found)
     * @param array  $config        configuration of application
     */
    protected function __construct($rootDirectory, array $config = [])
    {
        // add route directory to $config
        $config['rootDirectory'] = $rootDirectory;

        // create config
        $this->config = new Dotor($config);

        // create app
        $this->silex          = new Application();
        $this->silex['debug'] = $this->config->getBool('debugging', false);

        // set instance of Request
        $this->silex->before(function (Request $request) {
            if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
                $data = json_decode($request->getContent(), true);
                $request->request->replace(is_array($data) ? $data : array());
            }

            $this->request = $request;
        });

        $this->setupDatabase();
        $this->addRoutes();
    }


    /**
     * @return void
     */
    protected function addRoutes()
    {
        // minify js
        $this->silex->get('/min/js', function() {
            return $this->prepareAction(new Action\Minifier\JavaScript())->run();
        });

        // add task
        $this->silex->post('/task', function() {
            return $this->prepareAction(new Action\Task\Add())->run();
        });

        // delete
        $this->silex->delete('/task/{id}', function($id) {
            return $this->prepareAction(new Action\Task\Delete())->run($id);
        });

        // update
        $this->silex->put('/task/{id}', function($id) {
            return $this->prepareAction(new Action\Task\Update())->run($id);
        });

        // index
        $this->silex->get('/tasks', function() {
            return $this->prepareAction(new Action\Task\Index())->run();
        });
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
    public function getSilex()
    {
        return $this->silex;
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
    public function run()
    {
        $this->silex->run();
    }


    /**
     * @return void
     */
    protected function setupDatabase()
    {
        DB::configure([
            'todo' => [
                'dsn'      => sprintf('mysql:host=%s;dbname=%s', $this->config->get('database.host'), $this->config->get('database.name')),
                'username' => $this->config->get('database.username'),
                'password' => $this->config->get('database.password'),
            ]
        ]);
    }

}