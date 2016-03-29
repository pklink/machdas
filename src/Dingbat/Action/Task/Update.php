<?php


namespace Dingbat\Action\Task;

use Dingbat\Action;
use Dingbat\Model\Card;
use Dingbat\Model\Task;
use Slim\Http\Request;
use Slim\Http\Response;

class Update implements Action
{

    public function run(Request $request, Response $response, array $args)
    {
        $id = $args['id'];

        /* @var Task $task */
        $task = null;
        try {
            $task = Task::query()->findOrFail($id);
        } catch (\Exception $e) {
            return $response
                ->withStatus(404)
                ->withJson(['message' => sprintf('task with `id` `%d` does not exist', $id)]);
        }

        // check if cardId is set
        if ($request->getParsedBodyParam('cardId', false) === false)
        {
            return $response
                ->withStatus(400)
                ->withJson(['message' => 'param `cardId` is required']);
        }

        // check if cardId is exist
        $cardId = $request->getParsedBodyParam('cardId');
        if (Card::query()->find($cardId) === null)
        {
            return $response
                ->withStatus(400)
                ->withJson(['message' => sprintf('card with id `%d` does not exist', $cardId)]);
        }

        // check if `name` is set
        if ($request->getParsedBodyParam('name', false) === false)
        {
            return $response
                ->withStatus(400)
                ->withJson(['message' => 'param `name` is required']);
        }

        // check if `priority` value
        if (!in_array($request->getParsedBodyParam('priority', 'normal'), ['normal', 'high', 'low']))
        {
            return $response
                ->withStatus(400)
                ->withJson(['message' => 'param `priority` must be `normal`, `high` or `low`']);
        }

        // save task
        try
        {
            $task->name     = $request->getParsedBodyParam('name');
            $task->marked   = $request->getParsedBodyParam('marked');
            $task->priority = $request->getParsedBodyParam('priority', Task::PRIORITY_NORMAL);
            $task->cardId   = $cardId;
            $task->saveOrFail();

            return $response->withStatus(204);
        } catch (\Exception $e) {
            return $response
                ->withStatus(500)
                ->withJson(['message' => $e->getMessage()]);
        }
    }

}

