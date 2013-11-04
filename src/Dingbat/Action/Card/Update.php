<?php


namespace Dingbat\Action\Card;

use Dingbat\Action;
use Dingbat\Model\Card;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class Update
 *
 * @category Action
 * @package  Dingbat\Action\Card
 * @author   Pierre Klink <dev@klinks.info>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://github.com/pklink/Dingbat
 */
class Update extends Action
{

    /**
     * Update a card
     *
     * @param int $id ID of card
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function run($id)
    {
        $request = $this->request;

        /* @var Card $cart */
        $card = Card::get($id);
        $card->name = $request->get('name');
        $card->update();

        return JsonResponse::create(['success' => 1]);
    }

}

