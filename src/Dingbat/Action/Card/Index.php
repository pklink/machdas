<?php


namespace Dingbat\Action\Card;

use Dingbat\Action;
use Dingbat\Model\Card;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class Index
 *
 * @category Action
 * @package  Dingbat\Action\Task
 * @author   Pierre Klink <dev@klinks.info>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://github.com/pklink/Dingbat
 */
class Index extends Action
{

    /**
     * Get all task
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function run()
    {
        $cards = [];
        foreach (Card::objects()->orderBy('id', 'asc')->fetch() as $card) {
            $cards[] = [
                'id'       => (int) $card->id,
                'name'     => $card->name,
            ];
        }

        return JsonResponse::create($cards);
    }

}

