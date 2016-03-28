<?php


namespace Dingbat\Action\Card;

use Dingbat\Action;
use Dingbat\Model\Card;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class Index
 *
 * @category Action
 * @package  Dingbat\Action\Card
 * @author   Pierre Klink <dev@klinks.info>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://github.com/pklink/Dingbat
 */
class GetAll implements Action
{

    public function run(Request $request, Response $response, array $args)
    {
        $cards = [];
        /** @noinspection PhpUndefinedMethodInspection */
        foreach (Card::query()->orderBy('id', 'asc')->get() as $card) {
            /* @var \Dingbat\Model\Card $card */

            $cards[] = [
                'id'   => (int) $card->id,
                'name' => $card->name,
            ];
        }

        return $response->withJson($cards);
    }

}

