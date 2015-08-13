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
        // get card and delete it
        try {
            /* @var Card $card */
            /* @var \Phormium\QuerySet $query */
            $query = Card::objects()->filter('slug', '=', $slug);
            $card = $query->single();

            // delete all tasks of the card
            /* @var \Phormium\QuerySet $query */
            $query = Task::objects()->filter('cardid', '=', $card->id);
            $tasks = $query->fetch();

            foreach ($tasks as $task)
            {
                /* @var \Dingbat\Model\Task $task */
                $task->delete();
            }

            // delete card
            $card->delete();
        } catch (\Exception $e) { }

        return Response::create(null, 204);
    }

}

