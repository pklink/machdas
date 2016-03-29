<?php


namespace Dingbat\Action\Card;

use Dingbat\Action;
use Dingbat\Model\Card;
use Slim\Http\Request;
use Slim\Http\Response;

class GetAll implements Action
{

    public function run(Request $request, Response $response, array $args)
    {
        $cards = [];
        /** @noinspection PhpUndefinedMethodInspection */
        foreach (Card::query()->orderBy('id', 'asc')->get() as $card) {
            /* @var \Dingbat\Model\Card $card */

            $cards[] = [
                'id'   => (int) $card->id,
                'name' => $card->name,
            ];
        }

        return $response->withJson($cards);
    }

}

