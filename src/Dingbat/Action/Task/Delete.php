<?php


namespace Dingbat\Action\Task;

use Dingbat\Action;
use Dingbat\Model\Task;
use Slim\Http\Request;
use Slim\Http\Response;

class Delete implements Action
{

    function __invoke(Request $request, Response $response, array $args)
    {
        Task::destroy($args['id']);
        return $response->withStatus(204);
    }

}

