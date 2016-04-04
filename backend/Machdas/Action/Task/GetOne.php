<?php


namespace Machdas\Action\Task;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Machdas\Action;
use Machdas\Model\Task;
use Slim\Http\Request;
use Slim\Http\Response;

class GetOne extends Action\AbstractImpl
{

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     * @throws ModelNotFoundException
     */
    public function run(Request $request, Response $response, array $args) : Response
    {
        return $response->withJson(Task::query()->findOrFail($args['id']));
    }

}

