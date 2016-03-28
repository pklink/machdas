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

    const CODE_TASK_DOES_NOT_EXIST = 1;


    public function run(Request $request, Response $response, array $args)
    {
        $slug = $args['slug'];

        // get card
        try {
            /* @var Card $card */
            $card = Card::query()->where('slug', '=', $slug)->firstOrFail();

            return $response
                ->withJson([
                    'id'   => (int) $card->id,
                    'name' => $card->name,
                    'slug' => $card->slug
                ]);
        } catch (\Exception $e) {
            return $response
                ->withStatus(404)
                ->withJson([
                    'code'     => GetOne::CODE_TASK_DOES_NOT_EXIST,
                    'message'  => 'card does not exist'
                ]);
        }

    }

}

