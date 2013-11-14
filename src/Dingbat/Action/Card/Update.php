<?php


namespace Dingbat\Action\Card;

use Dingbat\Action;
use Dingbat\Model\Card;
use Dingbat\Model\Task;
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

    const CODE_ALL_FINE = 0;
    const CODE_CARD_DOES_NOT_EXIST = 1;
    const CODE_NAME_IS_NOT_GIVEN = 2;
    const CODE_UNKNOWN_ERROR = 999;


    /**
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function run($id)
    {
        $request = $this->request;

        /* @var Card $card */
        $card = null;
        try {
            $card = Card::get($id);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'code'    => Update::CODE_CARD_DOES_NOT_EXIST,
                'message' => sprintf('card with `id` `%d` does not exist', $id)
            ]);
        }

        // check if `name` is set
        if ($request->get('name', false) === false)
        {
            return JsonResponse::create([
                'code'    => Update::CODE_NAME_IS_NOT_GIVEN,
                'message' => 'param `name` is required'
            ]);
        }

        // save card
        try
        {
            $card->name     = $request->get('name');
            $card->update();

            return JsonResponse::create([
                'code'    => Update::CODE_ALL_FINE,
                'message' => 'all fine'
            ]);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'code'    => Update::CODE_UNKNOWN_ERROR,
                'message' => $e->getMessage()
            ]);
        }
    }

}

