<?php


namespace Dingbat;

use Dotor\Dotor;
use Silex\Application;
use Silex\Provider\TranslationServiceProvider;
use Symfony\Component\HttpFoundation\Request;
use Phormium\DB;
use Symfony\Component\Translation\Loader\YamlFileLoader;

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

        // register i18n service
        $this->silex->register(new TranslationServiceProvider(), array(
            'locale_fallbacks' => array('en'),
            'locale'           => $this->config->get('language'),
        ));

        // add translations
        $this->silex['translator'] = $this->silex->share($this->silex->extend('translator', function($translator) {
            $translator->addLoader('yaml', new YamlFileLoader());

            $translator->addResource('yaml', __DIR__.'/../res/locales/en.yml', 'en');
            $translator->addResource('yaml', __DIR__.'/../res/locales/de.yml', 'de');

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

        $this->setupDatabase();
        $this->addRoutes();
    }


    /**
     * @return void
     */
    protected function addRoutes()
    {
        // layout
        $this->silex->get('/', function() {
            $locale = $this->silex['translator'];

            ob_start();
            require(__DIR__ . '/../../views/layout.php');
            return ob_get_clean();
        });

        // js
        $this->silex->get('/assets/js', function() {
            return $this->prepareAction(new Action\Assets\JavaScript())->run();
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

        // list: index
        $this->silex->get('/cards', function() {
            return $this->prepareAction(new Action\Card\Index())->run();
        });

        // list: add
        $this->silex->post('/card', function() {
            return $this->prepareAction(new Action\Card\Add())->run();
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
            'databases' => [
                'todo' => [
                    'dsn'      => sprintf('mysql:host=%s;dbname=%s', $this->config->get('database.host'), $this->config->get('database.name')),
                    'username' => $this->config->get('database.username'),
                    'password' => $this->config->get('database.password'),
                ]
            ]
        ]);
    }

}