<?php


namespace Dingbat\Action\Card;

use Dingbat\Action;
use Dingbat\Model\Card;
use Slim\Http\Request;
use Slim\Http\Response;


class Update implements Action
{

    public function run(Request $request, Response $response, array $args)
    {
        $id = $args['id'];

        /* @var Card $card */
        $card = null;

        // get card
        try {
            $card = Card::query()->findOrFail($id);
        } catch (\Exception $e) {
            return $response
                ->withStatus(404)
                ->withJson(['message' => 'card does not exist']);
        }

        // set name and check if name is not empty
        $name = $request->getParsedBodyParam('name', false);
        if ($name !== false) {
            if (strlen($name) === 0) {
                return $response
                    ->withStatus(400)
                    ->withJson(['message' => '`name` cannot be empty']);
            }

            $card->name = $name;
        }

        // save card
        try {
            $card->saveOrFail();
            return $response->withStatus(204);
        } catch (\Exception $e) {
            return $response
                ->withStatus(500)
                ->withJson(['message' => $e->getMessage()]);
        }
    }

}

