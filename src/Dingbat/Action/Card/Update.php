<?php


namespace Dingbat\Action\Card;

use Dingbat\Action;
use Dingbat\Helper\SlugHelper;
use Dingbat\Model\Card;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class Update
 *
 * @category Action
 * @package  Dingbat\Action\Card
 * @author   Pierre Klink <dev@klinks.info>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://github.com/pklink/Dingbat
 */
class Update implements Action
{

    const CODE_CARD_DOES_NOT_EXIST = 1;
    const CODE_NAME_CANNOT_BE_EMPTY = 2;
    const CODE_SLUG_CANNOT_BE_EMPTY = 3;
    const CODE_SLUG_DUPLICATE = 4;
    const CODE_UNKNOWN_ERROR = 999;

    public function run(Request $request, Response $response, array $args)
    {
        $slug = $args['slug'];

        /* @var Card $card */
        $card = null;

        // get card
        try {
            $card = Card::query()->where('slug', '=', $slug)->firstOrFail();
        } catch (\Exception $e) {
            return $response
                ->withStatus(404)
                ->withJson([
                    'code' => Update::CODE_CARD_DOES_NOT_EXIST,
                    'message' => 'card does not exist'
                ]);
        }

        // get name and slug from payload
        $name = $request->getParsedBodyParam('name', false);
        $slug = $request->getParsedBodyParam('slug', false);

        // set name and check if name is not empty
        if ($name !== false) {
            if (strlen($name) === 0) {
                return $response
                    ->withStatus(400)
                    ->withJson([
                        'code' => Update::CODE_NAME_CANNOT_BE_EMPTY,
                        'message' => '`name` cannot be empty'
                    ]);
            }

            $card->name = $name;
        }

        // set slug
        if ($slug !== false) {
            // strip slug
            $slug = SlugHelper::convert($slug);

            // check if slug is not empty
            if (strlen($slug) == 0) {
                return $response
                    ->withStatus(400)
                    ->withJson([
                        'code' => Update::CODE_SLUG_CANNOT_BE_EMPTY,
                        'message' => '`name` cannot be empty'
                    ]);
            }

            // check if slug is duplicate
            $sluggedCard = Card::query()->where('slug', '=', $slug)->first();

            if ($sluggedCard instanceof Card && $sluggedCard->id != $card->id) {
                return $response
                    ->withStatus(409)
                    ->withJson([
                        'code' => Update::CODE_SLUG_DUPLICATE,
                        'message' => 'duplicate entry for `slug`'
                    ]);
            }

            $card->slug = $slug;
        }

        // save card
        try {
            $card->saveOrFail();

            return $response->withStatus(204);
        } catch (\Exception $e) {
            return $response
                ->withStatus(500)
                ->withJson([
                    'code' => Update::CODE_UNKNOWN_ERROR,
                    'message' => $e->getMessage()
                ]);
        }
    }

}

