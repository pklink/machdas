<?php


namespace Dingbat\Action\Task;

use Dingbat\Action;
use Dingbat\Model\Task;
use Respect\Validation\Exceptions\NestedValidationException;
use Slim\Http\Request;
use Slim\Http\Response;

class Create extends Action\AbstractImpl
{

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     * @throws NestedValidationException
     */
    public function run(Request $request, Response $response, array $args)
    {
        // create task
        $model           = new Task();
        $model->name     = $request->getParsedBodyParam('name');
        $model->marked   = (bool) $request->getParsedBodyParam('marked', false);
        $model->priority = $request->getParsedBodyParam('priority', Task::PRIORITY_NORMAL);
        $model->cardId   = (int) $request->getParsedBodyParam('cardId');

        // validation
        Task::validators()['name']->assert($model->name);
        Task::validators()['marked']->assert($model->marked);
        Task::validators()['priority']->assert($model->priority);
        Task::validators()['cardId']->assert($model->cardId);

        // save
        $model->saveOrFail();

        // response
        return $response
            ->withStatus(201)
            ->withHeader('Location', sprintf('/tasks/%d', $model->id))
            ->withJson(['id' => (int) $model->id]);
    }

}

