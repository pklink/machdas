<?php


namespace Dingbat\Action\Card;

use Dingbat\Action;
use Dingbat\Model\Card;
use Slim\Http\Request;
use Slim\Http\Response;

class Create implements Action
{

    public function run(Request $request, Response $response, array $args)
    {
        $name = $request->getParsedBodyParam('name', false);

        // check name
        if ($name === false) {
            return $response
                ->withStatus(400)
                ->withJson(['message' => '`name` is required']);
        }

        // save card
        try {
            $card       = new Card();
            $card->name = $name;
            $card->saveOrFail();

            return $response
                ->withStatus(201)
                ->withHeader('Location', sprintf('/cards/%s', $card->id))
                ->withJson(['id' => (int)$card->id]);
        } catch (\Exception $e) {
            return $response
                ->withStatus(500)
                ->withJson(['message' => $e->getMessage()]);
        }
    }

}

