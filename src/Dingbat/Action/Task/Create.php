<?php


namespace Dingbat\Action\Task;

use Dingbat\Action;
use Dingbat\Model\Card;
use Dingbat\Model\Task;
use Slim\Http\Request;
use Slim\Http\Response;

class Create implements Action
{

    public function __invoke(Request $request, Response $response, array $args)
    {
        // check if cardId is set
        if ($request->getParsedBodyParam('cardId', false) === false) {
            return $response
                ->withStatus(400)
                ->withJson(['message' => 'param `cardId` is required']);
        }

        // check if cardId is exist
        $cardId = $request->getParsedBodyParam('cardId');
        if (Card::query()->find($cardId) === null) {
            return $response
                ->withStatus(400)
                ->withJson(['message' => sprintf('card with id `%d` does not exist', $cardId)]);
        }

        // check if `name` is set
        if ($request->getParsedBodyParam('name', false) === false) {
            return $response
                ->withStatus(400)
                ->withJson(['message' => 'param `name` is required']);
        }

        // check if `priority` value
        if (!in_array($request->getParsedBodyParam('priority', 'normal'), ['normal', 'high', 'low'])) {
            return $response
                ->withStatus(400)
                ->withJson(['message' => 'param `priority` must be `normal`, `high` or `low`']);
        }

        // save task
        try {
            $task           = new Task();
            $task->name     = $request->getParsedBodyParam('name');
            $task->marked   = $request->getParsedBodyParam('marked', false);
            $task->priority = $request->getParsedBodyParam('priority', Task::PRIORITY_NORMAL);
            $task->cardId   = $request->getParsedBodyParam('cardId', $cardId);
            $task->saveOrFail();

            return $response
                ->withStatus(201)
                ->withHeader('Location', sprintf('/tasks/%d', $task->id))
                ->withJson(['id' => (int) $task->id]);
        } catch (\Exception $e) {
            return $response
                ->withStatus(500)
                ->withJson(['message' => $e->getMessage()]);
        }
    }

}

