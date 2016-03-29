<?php


namespace Dingbat\Action\Task;

use Dingbat\Action;
use Dingbat\Model\Task;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Respect\Validation\Exceptions\NestedValidationException;
use Slim\Http\Request;
use Slim\Http\Response;

class Update implements Action
{

    public function __invoke(Request $request, Response $response, array $args)
    {
        try {
            // load and fill model
            /* @var Task $model */
            $model           = Task::query()->findOrFail($args['id']);
            $model->name     = $request->getParsedBodyParam('name');
            $model->marked   = (bool) $request->getParsedBodyParam('marked');
            $model->priority = $request->getParsedBodyParam('priority', Task::PRIORITY_NORMAL);
            $model->cardId   = (int) $request->getParsedBodyParam('cardId');

            // validation
            Task::validators()['name']->assert($model->name);
            Task::validators()['marked']->assert($model->marked);
            Task::validators()['priority']->assert($model->priority);
            Task::validators()['cardId']->assert($model->cardId);

            // save
            $model->saveOrFail();

            return $response->withStatus(204);
        } catch (ModelNotFoundException $e) {
            return $response
                ->withStatus(404)
                ->withJson(['message' => sprintf('task with `id` `%d` does not exist', $args['id'])]);
        } catch (NestedValidationException $e) {
            // validation error
            return $response
                ->withStatus(400)
                ->withJson(['message' => $e->getFullMessage()]);
        } catch (\Exception $e) {
            return $response
                ->withStatus(500)
                ->withJson(['message' => $e->getMessage()]);
        }
    }

}

