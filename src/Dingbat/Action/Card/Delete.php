<?php


namespace Dingbat\Action\Card;

use Dingbat\Action;
use Dingbat\Model\Card;
use Dingbat\Model\Task;
use Symfony\Component\HttpFoundation\JsonResponse;

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

    const CODE_ALL_FINE = 0;
    const CODE_CARD_DOES_NOT_EXIST = 1;
    const CODE_UNKNOW_ERROR = 999;


    /**
     * @param integer $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function run($id)
    {
        $card = null;

        // get card
        try {
            $card = Card::get($id);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'code'    => Delete::CODE_CARD_DOES_NOT_EXIST,
                'message' => sprintf('card with `id` `%d` does not exist', $id)
            ]);
        }

        // delete card
        try {
            $card->delete();

            return JsonResponse::create([
                'code'    => Delete::CODE_ALL_FINE,
                'message' => 'all fine'
            ]);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'code'    => Delete::CODE_UNKNOW_ERROR,
                'message' => $e->getMessage()
            ]);
        }
    }

}

