<?php


namespace Dingbat\Action\Task;

use Dingbat\Action;
use Dingbat\Model\Task;
use Slim\Http\Request;
use Slim\Http\Response;

class GetAll implements Action
{

    public function __invoke(Request $request, Response $response, array $args)
    {
        $tasks = [];
        /** @noinspection PhpUndefinedMethodInspection */
        foreach (Task::query()->orderBy('id', 'asc')->get() as $task) {
            $tasks[] = [
                'id'       => (int) $task->id,
                'name'     => $task->name,
                'marked'   => (bool) $task->marked,
                'priority' => $task->priority,
                'cardId'   => (int) $task->cardId
            ];
        }

        return $response->withJson($tasks);
    }

}

