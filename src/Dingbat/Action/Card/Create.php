<?php


namespace Dingbat\Action\Card;

use Dingbat\Action;
use Dingbat\Model\Card;
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
            ->withJson($model);

    }

}

