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
class Create extends Action
{

    const CODE_NAME_IS_REQUIRED = 1;
    const CODE_UNKNOWN_ERROR = 999;

    /**
     * Create new task
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function run()
    {
        $request = $this->request;

        // check name
        if ($request->get('name', false) === false)
        {
            return JsonResponse::create([
                'id'      => null,
                'code'    => Create::CODE_NAME_IS_REQUIRED,
                'message' => '`name` is required',
            ], 400);
        }

        // save card
        try {
            $card = new Card();
            $card->name = $request->get('name');
            $card->save();

            return JsonResponse::create([
                'id'      => (int) $card->id
            ], 201);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'code'    => Create::CODE_UNKNOWN_ERROR,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

}

