<?php


namespace Machdas\Action\Card;

use Machdas\Action;
use Machdas\Model\Card;
use Machdas\Model\Task;
use Machdas\Utils\DatabaseUtils;
use Respect\Validation\Exceptions\NestedValidationException;
use Slim\Http\Request;
use Slim\Http\Response;

class CreateTask extends Action\AbstractImpl
{

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     * @throws NestedValidationException
     */
    public function run(Request $request, Response $response, array $args) : Response
    {
        /* @var Card $card */
        $card = Card::query()->findOrFail($args['id']);

        // create task
        $model           = new Task();
        $model->name     = $request->getParsedBodyParam('name');
        $model->isDone   = (bool) $request->getParsedBodyParam('isDone', false);
        $model->priority = DatabaseUtils::parseTaskPriority($request->getParsedBodyParam('priority', 500));
        $model->cardId   = $card->id;

        // validation
        Task::validators()['name']->assert($model->name);
        Task::validators()['isDone']->assert($model->isDone);
        Task::validators()['priority']->assert($model->priority);

        // save
        $model->saveOrFail();

        // response
        return $response
            ->withStatus(201)
            ->withHeader('Location', sprintf('/tasks/%d', $model->id))
            ->withJson($model);
    }
}
