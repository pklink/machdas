<?php


namespace Dingbat\Action\Task;

use Dingbat\Action;
use Dingbat\Model\Task;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
    public function run(Request $request, Response $response, array $args)
    {
        /* @var Task $task */
        $task = Task::query()->findOrFail($args['id']);

        return $response->withJson([
            'id'       => (int) $task->id,
            'cardId'   => (int) $task->cardId,
            'name'     => $task->name,
            'isDone'   => (bool) $task->isDone,
            'priority' => $task->priority
        ]);
    }

}

