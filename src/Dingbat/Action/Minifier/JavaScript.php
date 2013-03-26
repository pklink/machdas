<?php


namespace Dingbat\Action\Minifier;


use Dingbat\App;
use Dingbat\Action;
use Dingbat\Model\Task;
use JShrink\Minifier;
use Symfony\Component\HttpFoundation\Response;

class JavaScript extends Action
{

    /**
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function run()
    {
        $config = App::instance()->getConfig();
        $path   = $config->get('minifier.path');

        $js = '';
        foreach ($config->getArray('minifier.scripts') as $script) {
            $js .= file_get_contents($path . DIRECTORY_SEPARATOR . $script . '.js');
        }

        $response = new Response(Minifier::minify($js));
        $response->headers->set('Content-Type', 'application/javascript');
        return $response;
    }

}

