<?php


namespace Dingbat\Action\Card;

use Dingbat\Action;
use Dingbat\Model\Card;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Respect\Validation\Exceptions\NestedValidationException;
use Slim\Http\Request;
use Slim\Http\Response;


class Update implements Action
{

    public function __invoke(Request $request, Response $response, array $args)
    {
        try {
            // retrieve and fill model
            /* @var Card $model */
            $model       = Card::query()->findOrFail($args['id']);
            $model->name = $request->getParsedBodyParam('name', $model->name);

            // validation
            Card::validators()['name']->assert($model->name);

            // save
            $model->saveOrFail();

            // response
            return $response->withStatus(204);
        } catch (NestedValidationException $e) {
            // validation error
            return $response
                ->withStatus(400)
                ->withJson(['message' => $e->getFullMessage()]);
        } catch (ModelNotFoundException $e) {
            // model not found
            return $response
                ->withStatus(404)
                ->withJson(['message' => 'card does not exist']);
        } catch (\Exception $e) {
            // enexpected error
            return $response
                ->withStatus(500)
                ->withJson(['message' => $e->getMessage()]);
        }
    }

}

