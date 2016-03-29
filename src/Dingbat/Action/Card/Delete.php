<?php


namespace Dingbat\Action\Card;

use Dingbat\Action;
use Dingbat\Model\Card;
use Dingbat\Model\Task;
use Slim\Http\Request;
use Slim\Http\Response;

class Delete implements Action
{

    public function __invoke(Request $request, Response $response, array $args)
    {
        $id = $args['id'];

        try {
            // find card
            /* @var Card $card */
            $card = Card::query()->findOrFail($id);

            // delete tasks of card
            Task::query()->where('cardId', $card->id);

            // delete card
            $card->delete();
        } catch (\Exception $e) {
            // not needed. respose code is always 204
        }

        return $response->withStatus(204);
    }

}

