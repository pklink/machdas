<?php


namespace Dingbat\Action\Card;

use Dingbat\Action;
use Dingbat\Model\Card;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Slim\Http\Request;
use Slim\Http\Response;

class GetOne extends Action\AbstractImpl
{

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     * @throws ModelNotFoundException
     */
    public function run(Request $request, Response $response, array $args) : Response
    {
        return $response->withJson(Card::query()->findOrFail($args['id']));
    }

}

