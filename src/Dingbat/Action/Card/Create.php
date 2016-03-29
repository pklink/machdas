<?php


namespace Dingbat\Action\Card;

use Dingbat\Action;
use Dingbat\Model\Card;
use Respect\Validation\Exceptions\NestedValidationException;
use Slim\Http\Request;
use Slim\Http\Response;

class Create implements Action
{

    public function __invoke(Request $request, Response $response, array $args)
    {
        try {
            // create model
            $model       = new Card();
            $model->name = $request->getParsedBodyParam('name', false);

            // validation
            Card::validators()['name']->assert($model->name);

            // create
            $model->saveOrFail();

            // response
            return $response
                ->withStatus(201)
                ->withHeader('Location', sprintf('/cards/%s', $model->id))
                ->withJson(['id' => (int) $model->id]);
        } catch (NestedValidationException $e) {
            // validation error
            return $response
                ->withStatus(400)
                ->withJson(['message' => $e->getFullMessage()]);
        } catch (\Exception $e) {
            // unexpected error
            return $response
                ->withStatus(500)
                ->withJson(['message' => $e->getMessage()]);
        }
    }


}

