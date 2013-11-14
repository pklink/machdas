<?php


namespace Dingbat\Action\Card;

use Dingbat\Action;
use Dingbat\Model\Card;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class Get
 *
 * @category Action
 * @package  Dingbat\Action\Card
 * @author   Pierre Klink <dev@klinks.info>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://github.com/pklink/Dingbat
 */
class GetOne extends Action
{

    const CODE_ALL_FINE = 0;
    const CODE_TASK_DOES_NOT_EXIST = 1;


    /**
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function run($id)
    {
        $request  = $this->request;

        // get card
        try {
            /* @var Card $card */
            $card = Card::get($id);

            return JsonResponse::create([
                'id'       => (int) $card->id,
                'name'     => $card->name,
                'code'     => GetOne::CODE_ALL_FINE,
                'message'  => 'all fine'
            ]);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'id'       => null,
                'name'     => null,
                'code'     => GetOne::CODE_TASK_DOES_NOT_EXIST,
                'message'  => sprintf('card with `id` `%s` does not exist', $id)
            ]);
        }

    }

}

