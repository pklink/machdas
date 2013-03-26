<?php


namespace Dingbat;

use Dotor\Dotor;
use Silex\Application;
use Silex\Provider\UrlGeneratorServiceProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Phormium\DB;

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
     * @param string $rootDirectory
     * @param array  $config
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
        $this->silex->before(function (Request $request) use (&$bla) {
            if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
                $data = json_decode($request->getContent(), true);
                $request->request->replace(is_array($data) ? $data : array());
            }

            $this->request = $request;
        });


        // register url-generator
        $this->silex->register(new UrlGeneratorServiceProvider());

        $this->setupDatabase();
        $this->addRoutes();
    }


    /**
     * @return void
     */
    protected function addRoutes()
    {
        // add task
        $this->silex->post('/task', function() {
            return (new Action\Task\Add())->run();
        })->bind('task');

        // delete
        $this->silex->delete('/task/{id}', function($id) {
            return (new Action\Task\Delete())->run($id);
        });

        // update
        $this->silex->put('/task/{id}', function($id) {
            return (new Action\Task\Update())->run($id);
        });

        // index
        $this->silex->get('/tasks', function() {
            return (new Action\Task\Index())->run();
        })->bind('tasks');
    }


    /**
     * @param string $projectRoot path to root path of project
     * @param array $config
     * @return App
     * @throws \InvalidArgumentException
     */
    public static function instance($projectRoot = null, array $config = [])
    {
        if (!(self::$instance instanceof Todo))
        {
            if (is_null($projectRoot))
            {
                throw new \InvalidArgumentException('At first call of Todo::app() is the $projectPath-parameter required');
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