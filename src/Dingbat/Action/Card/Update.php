<?php


namespace Dingbat\Action\Card;

use Dingbat\Action;
use Dingbat\Model\Card;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Respect\Validation\Exceptions\NestedValidationException;
use Slim\Http\Request;
use Slim\Http\Response;


class Update extends Action\AbstractImpl
{

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     * @throws ModelNotFoundException
     * @throws NestedValidationException
     */
    public function run(Request $request, Response $response, array $args) : Response
    {
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
    }

}

