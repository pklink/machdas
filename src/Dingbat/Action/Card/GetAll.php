<?php


namespace Dingbat\Action\Card;

use Dingbat\Action;
use Dingbat\Model\Card;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class Index
 *
 * @category Action
 * @package  Dingbat\Action\Card
 * @author   Pierre Klink <dev@klinks.info>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://github.com/pklink/Dingbat
 */
class GetAll extends Action
{

    /**
     * @param string $filter attribute=value;otherattribute=value
     * @return \Symfony\Component\HttpFoundation\Response|static
     */
    public function run($filter = null)
    {
        $cards = [];
        foreach (Card::query()->orderBy('id', 'asc')->get() as $card) {
            /* @var \Dingbat\Model\Card $card */

            $cards[] = [
                'id'   => (int) $card->id,
                'name' => $card->name,
                'slug' => $card->slug
            ];
        }

        return JsonResponse::create($cards);
    }

}

