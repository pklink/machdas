<?php


namespace Dingbat\Action\Card;

use Dingbat\Action;
use Dingbat\Model\Card;
use Psr\Http\Message\ResponseInterface;
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
class GetAll extends Action
{

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function run(Request $request, Response $response)
    {
        $cards = [];
        /** @noinspection PhpUndefinedMethodInspection */
        foreach (Card::query()->orderBy('id', 'asc')->get() as $card) {
            /* @var \Dingbat\Model\Card $card */

            $cards[] = [
                'id'   => (int) $card->id,
                'name' => $card->name,
                'slug' => $card->slug
            ];
        }

        return $response->withJson($cards);
    }

}

