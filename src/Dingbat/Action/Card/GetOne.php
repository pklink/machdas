<?php


namespace Dingbat\Action\Card;

use Dingbat\Action;
use Dingbat\Model\Card;
use Slim\Http\Request;
use Slim\Http\Response;

class GetOne implements Action
{

    public function __invoke(Request $request, Response $response, array $args)
    {
        $id = $args['id'];

        // get card
        try {
            /* @var Card $card */
            $card = Card::query()->findOrFail($id);

            return $response
                ->withJson([
                    'id'   => (int) $card->id,
                    'name' => $card->name,
                ]);
        } catch (\Exception $e) {
            return $response
                ->withStatus(404)
                ->withJson(['message' => 'card does not exist']);
        }

    }

}

