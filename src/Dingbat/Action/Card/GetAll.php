<?php


namespace Dingbat\Action\Card;

use Dingbat\Action;
use Dingbat\Model\Card;
use Symfony\Component\HttpFoundation\JsonResponse;

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
     * @param string $filter attribute=value;otherattribute=value
     * @return \Symfony\Component\HttpFoundation\Response|static
     */
    public function run($filter = null)
    {
        $objects = Card::objects();

        // filter
        if ($filter != null)
        {
            $conditions = explode(';', $filter);

            foreach ($conditions as $condition)
            {
                $splits = explode('=', $condition);

                if (!isset($splits[1])) {
                    continue;
                }

                $attribute = $splits[0];
                $value     = $splits[1];

                switch ($attribute)
                {
                    case 'id':
                        $objects = $objects->filter($attribute, '=', $value);
                        break;

                    case 'name':
                        $objects = $objects->filter($attribute, 'LIKE', '%' . $value . '%');
                        break;
                }
            }
        }

        $cards = [];
        foreach ($objects->orderBy('id', 'asc')->fetch() as $card) {
            /* @var \Dingbat\Model\Card $card */

            $cards[] = [
                'id'   => (int) $card->id,
                'name' => $card->name,
                'slug' => $card->slug
            ];
        }

        return JsonResponse::create($cards);
    }

}

