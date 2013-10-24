<?php


namespace Dingbat\Action\Card;

use Dingbat\Action;
use Dingbat\Model\Card;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class Add
 *
 * @category Action
 * @package  Dingbat\Action\Task
 * @author   Pierre Klink <dev@klinks.info>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://github.com/pklink/Dingbat
 */
class Add extends Action
{

    /**
     * Create new task
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function run()
    {
        $request = $this->request;

        $card = new Card();
        $card->name = $request->get('name');
        $card->save();

        $return = [
            'id'   => $card->id,
            'name' => $card->name,
        ];

        return JsonResponse::create($return);
    }

}

