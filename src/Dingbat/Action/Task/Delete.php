<?php


namespace Dingbat\Action\Task;

use Dingbat\Action;
use Dingbat\Model\Task;
use Slim\Http\Request;
use Slim\Http\Response;

class Delete extends Action\AbstractImpl
{

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function run(Request $request, Response $response, array $args) : Response
    {
        Task::destroy($args['id']);
        return $response->withStatus(204);
    }

}

