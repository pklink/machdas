<?php


namespace Machdas\Action\Card;

use Machdas\Action;
use Machdas\Model\Card;
use Slim\Http\Request;
use Slim\Http\Response;

class GetAll extends Action\AbstractImpl
{

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function run(Request $request, Response $response, array $args) : Response
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $cards = Card::query()->orderBy('id', 'asc')->get();
        return $response->withJson($cards);
    }
}
