<?php


namespace Dingbat\Action\Card;

use Dingbat\Action;
use Dingbat\Helper\SlugHelper;
use Dingbat\Model\Card;
use Symfony\Component\HttpFoundation\Response;
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

    const CODE_CARD_DOES_NOT_EXIST  = 1;
    const CODE_NAME_CANNOT_BE_EMPTY = 2;
    const CODE_SLUG_CANNOT_BE_EMPTY = 3;
    const CODE_SLUG_DUPLICATE       = 4;
    const CODE_UNKNOWN_ERROR        = 999;

    /**
     * @param string $slug
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function run($slug)
    {
        $request = $this->request;

        /* @var Card $card */
        $card = null;

        // get card
        try {
            $card = Card::objects()->filter('slug', '=', $slug)->single();
        } catch (\Exception $e) {
            return JsonResponse::create([
                'code'    => Update::CODE_CARD_DOES_NOT_EXIST,
                'message' => 'card does not exist'
            ], 404);
        }

        // get name and slug from payload
        $name = $request->get('name', false);
        $slug = $request->request->get('slug', false);

        // set name
        if ($name !== false)
        {
            // check if name is not empty
            if (strlen($name) == 0)
            {
                return JsonResponse::create([
                    'code'    => Update::CODE_NAME_CANNOT_BE_EMPTY,
                    'message' => '`name` cannot be empty'
                ], 400);
            }

            $card->name = $request->get('name');
        }

        // set slug
        if ($slug !== false)
        {
            // strip slug
            $slug = SlugHelper::convert($slug);

            // check if slug is not empty
            if (strlen($slug) == 0)
            {
                return JsonResponse::create([
                    'code'    => Update::CODE_SLUG_CANNOT_BE_EMPTY,
                    'message' => '`name` cannot be empty'
                ]);
            }

            // check if slug is duplicate
            $sluggedCard = Card::objects()->filter('slug', '=', $slug)->single(true);

            if ($sluggedCard instanceof Card && $sluggedCard->id != $card->id)
            {
                return JsonResponse::create([
                    'code'    => Update::CODE_SLUG_DUPLICATE,
                    'message' => 'duplicate entry for `slug`'
                ], 409);
            }

            $card->slug = $slug;
        }

        // save card
        try
        {
            $card->update();

            return JsonResponse::create([
                'uri' => sprintf('/cards/%s', $card->slug)
            ]);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'code'    => Update::CODE_UNKNOWN_ERROR,
                'message' => $e->getMessage()
            ], 500);
        }
    }

}

