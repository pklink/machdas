<?php


namespace Dingbat\Action\Card;

use Dingbat\Action;
use Dingbat\Model\Card;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class Get
 *
 * @category Action
 * @package  Dingbat\Action\Card
 * @author   Pierre Klink <dev@klinks.info>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://github.com/pklink/Dingbat
 */
class GetOne implements Action
{

    public function run(Request $request, Response $response, array $args)
    {
        $id = $args['id'];

        // get card
        try {
            /* @var Card $card */
            $card = Card::query()->findOrFail($id);

            return $response
                ->withJson([
                    'id'   => (int) $card->id,
                    'name' => $card->name,
                ]);
        } catch (\Exception $e) {
            return $response
                ->withStatus(404)
                ->withJson(['message' => 'card does not exist']);
        }

    }

}

