<?php


namespace Machdas\Action\Card;

use Machdas\Action;
use Machdas\Model\Card;
use Machdas\Model\Task;
use Slim\Http\Request;
use Slim\Http\Response;

class CountTasks extends Action\AbstractImpl
{

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function run(Request $request, Response $response, array $args) : Response
    {
        // load all cards
        /* @var Card[] $cards */
        $cards = Card::query()->get();

        $counts = [];
        foreach ($cards as $card) {
            /** @noinspection PhpUndefinedMethodInspection */
            $counts[] = [
                'card'  => $card->id,
                'count' => Task::query()->where('cardId', '=', $card->id)->count()
            ];
        }

        return $response->withJson($counts);
    }

}
