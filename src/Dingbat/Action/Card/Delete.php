<?php


namespace Dingbat\Action\Card;

use Dingbat\Action;
use Dingbat\Model\Card;
use Dingbat\Model\Task;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class Delete
 *
 * @category Action
 * @package  Dingbat\Action\Card
 * @author   Pierre Klink <dev@klinks.info>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://github.com/pklink/Dingbat
 */
class Delete extends Action
{

    /**
     * @param string $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function run($slug)
    {
        try {
            // find card
            $card = Card::query()->where('slug', $slug)->firstOrFail();

            // delete tasks of card
            Task::query()->where('cardid', $card->id);

            // delete card
            $card->delete();
        } catch (\Exception $e) { }

        return Response::create(null, 204);
    }

}

