<?php


namespace Dingbat\Action\Task;

use Dingbat\Action;
use Dingbat\Model\Task;
use Slim\Http\Request;
use Slim\Http\Response;

class GetAll extends Action\AbstractImpl
{

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function run(Request $request, Response $response, array $args)
    {
        $tasks = [];
        /** @noinspection PhpUndefinedMethodInspection */
        foreach (Task::query()->orderBy('id', 'asc')->get() as $task) {
            /* @var Task $task */
            $tasks[] = [
                'id'       => (int) $task->id,
                'name'     => $task->name,
                'isDone'   => (bool) $task->isDone,
                'priority' => $task->priority,
                'cardId'   => (int) $task->cardId
            ];
        }

        return $response->withJson($tasks);
    }

}

