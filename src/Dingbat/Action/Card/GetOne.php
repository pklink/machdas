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

    const CODE_TASK_DOES_NOT_EXIST = 1;


    /**
     * @param string $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function run($slug)
    {
        // get card
        try {
            /* @var Card $card */
            $card = Card::objects()->filter('slug', '=', $slug)->single();

            return JsonResponse::create([
                'id'   => (int) $card->id,
                'name' => $card->name,
                'slug' => $card->slug
            ]);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'code'     => GetOne::CODE_TASK_DOES_NOT_EXIST,
                'message'  => 'card does not exist'
            ], 404);
        }

    }

}

