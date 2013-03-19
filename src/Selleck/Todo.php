<?php


namespace Selleck;

use RedBean_Facade as R;
use Dotor\Dotor;
use Selleck\Todo\Action;
use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class Todo
{

    /**
     * @var \Dotor\Dotor
     */
    protected $config;


    /**
     * @var Todo
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

        // create instance of Request
        $this->request = Request::createFromGlobals();

        // create app
        $this->silex          = new Application();
        $this->silex['debug'] = true;

        // register twig
        $this->silex->register(new TwigServiceProvider(), array(
            'twig.path' => $this->config->get('rootDirectory') . '/themes/default'
        ));

        $this->setupDatabase();
        $this->addRoutes();
    }


    /**
     * @return void
     */
    protected function addRoutes()
    {
        // default route
        $this->silex->match('/', function() {
            return (new Action\Task\Index())->get();
        });
    }


    /**
     * @param string $projectRoot path to root path of project
     * @param array $config
     * @return Todo
     * @throws \InvalidArgumentException
     */
    public static function app($projectRoot = null, array $config = [])
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
        R::setup(
            sprintf('mysql:host=%s;dbname=%s', $this->config->get('database.host'), $this->config->get('database.name')),
            $this->config->get('database.username'),
            $this->config->get('database.password')
        );
    }

}