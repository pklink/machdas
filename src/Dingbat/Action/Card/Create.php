<?php


namespace Dingbat\Action\Card;

use Dingbat\Action;
use Dingbat\Helper\SlugHelper;
use Dingbat\Model\Card;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class Add
 *
 * @category Action
 * @package  Dingbat\Action\Card
 * @author   Pierre Klink <dev@klinks.info>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://github.com/pklink/Dingbat
 */
class Create implements Action
{

    public function run(Request $request, Response $response, array $args)
    {
        $name = $request->getParsedBodyParam('name', false);
        $slug = strtolower($request->getParsedBodyParam('slug', ''));

        // check name
        if ($name === false) {
            return $response
                ->withStatus(400)
                ->withJson(['message' => '`name` is required']);
        }

        // check slug
        $slug = SlugHelper::convert($slug);
        if (strlen($slug) == 0) {
            return $response
                ->withStatus(400)
                ->withJson(['message' => '`slug` is required']);
        }

        // duplicate slug
        if (Card::query()->where('slug', $slug)->first() instanceof Card) {
            return $response
                ->withStatus(409)
                ->withJson(['message' => 'duplicate entry for `slug`']);
        }

        // save card
        try {
            $card = new Card();
            $card->name = $name;
            $card->slug = $slug;
            $card->saveOrFail();

            return $response
                ->withStatus(201)
                ->withHeader('Location', sprintf('/cards/%s', $slug))
                ->withJson(['id' => (int) $card->id]);
        } catch (\Exception $e) {
            return $response
                ->withStatus(500)
                ->withJson(['message' => $e->getMessage()]);
        }
    }

}

