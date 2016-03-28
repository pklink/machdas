<?php


namespace Dingbat;

use Dotor\Dotor;
use Illuminate\Database\Capsule\Manager;
use Silex\Application;
use Silex\Provider\TranslationServiceProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\Loader\YamlFileLoader;
use Symfony\Component\Translation\Translator;

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
        $this->silex          = new Application();
        $this->silex['debug'] = $this->config->getBool('debugging', false);

        // register i18n service
        $this->silex->register(new TranslationServiceProvider(), array(
            'locale_fallbacks' => array('en'),
            'locale'           => $this->config->get('language'),
        ));

        // add translations
        $this->silex['translator'] = $this->silex->share($this->silex->extend('translator', function($translator) {
            /* @var Translator $translator */
            $translator->addLoader('yaml', new YamlFileLoader());

            $localePath = $this->config->get('rootDirectory', 'bla') . '/src/res/locales';
            $translator->addResource('yaml', $localePath . '/en.yml', 'en');
            $translator->addResource('yaml', $localePath . '/de.yml', 'de');

            return $translator;
        }));

        // set instance of Request
        $this->silex->before(function (Request $request) {
            if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
                $data = json_decode($request->getContent(), true);
                $request->request->replace(is_array($data) ? $data : array());
            }

            $this->request = $request;
        });

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
        $this->silex->run();
    }

    /**
     * @return void
     */
    protected function setRoutes()
    {
        // layout
        $this->silex->get('/', function() {
            ob_start();

            $appName = $this->config->get('name', 'Dingbat');
            $locale  = $this->silex['translator'];

            require(__DIR__ . '/../../views/layout.php');
            return ob_get_clean();
        });

        // cards
        $this->silex->post('/cards', function() {
            return $this->prepareAction(new Action\Card\Create())->run();
        });

        $this->silex->get('/cards', function() {
            return $this->prepareAction(new Action\Card\GetAll())->run();
        });

        $this->silex->get('/cards/{slug}', function($slug) {
            return $this->prepareAction(new Action\Card\GetOne())->run($slug);
        });

        $this->silex->put('/cards/{slug}', function($slug) {
            return $this->prepareAction(new Action\Card\Update())->run($slug);
        });

        $this->silex->delete('/cards/{slug}', function($slug) {
            return $this->prepareAction(new Action\Card\Delete())->run($slug);
        });





        /*
        $this->silex->get('/cards/{filter}', function($filter) {
            return $this->prepareAction(new Action\Card\GetAll())->run($filter);
        });
        */



        // tasks
        $this->silex->post('/task', function() {
            return $this->prepareAction(new Action\Task\Create())->run();
        });

        $this->silex->get('/task/{id}', function($id) {
            return $this->prepareAction(new Action\Task\GetOne())->run($id);
        });

        $this->silex->get('/tasks', function() {
            return $this->prepareAction(new Action\Task\GetAll())->run();
        });

        $this->silex->get('/tasks/{filter}', function($filter) {
            return $this->prepareAction(new Action\Task\GetAll())->run($filter);
        });

        $this->silex->put('/task/{id}', function($id) {
            return $this->prepareAction(new Action\Task\Update())->run($id);
        });

        $this->silex->delete('/task/{id}', function($id) {
            return $this->prepareAction(new Action\Task\Delete())->run($id);
        });

    }

}