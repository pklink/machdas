<?php


namespace Dingbat\Action\Card;

use Dingbat\Action;
use Dingbat\Model\Card;
use Dingbat\Model\Task;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class Delete
 *
 * @category Action
 * @package  Dingbat\Action\Card
 * @author   Pierre Klink <dev@klinks.info>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://github.com/pklink/Dingbat
 */
class Delete implements Action
{

    public function run(Request $request, Response $response, array $args)
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
        } catch (\Exception $e) { }

        return $response->withStatus(204);
    }

}

