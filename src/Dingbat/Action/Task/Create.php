<?php


namespace Dingbat\Action\Task;

use Dingbat\Action;
use Dingbat\Model\Card;
use Dingbat\Model\Task;
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

    const CODE_ALL_FINE = 0;
    const CODE_CARD_ID_IS_NOT_GIVEN = 1;
    const CODE_CARD_DOES_NOT_EXIST = 2;
    const CODE_NAME_IS_NOT_GIVEN = 3;
    const CODE_PRIORITY_IS_INVALID = 4;
    const CODE_UNKNOWN_ERROR = 999;

    /**
     * Create new task
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function run()
    {
        $request = $this->request;

        // check if cardId is set
        if ($request->get('cardId', false) === false)
        {
            return JsonResponse::create([
                'id'      => null,
                'code'    => Create::CODE_CARD_ID_IS_NOT_GIVEN,
                'message' => 'param `cardId` is required'
            ]);
        }

        // check if cardId is exist
        if (!Card::exists($request->get('cardId')))
        {
            return JsonResponse::create([
                'id'      => null,
                'code'    => Create::CODE_CARD_DOES_NOT_EXIST,
                'message' => sprintf('card with id `%d` does not exist', $request->get('cardId'))
            ]);
        }

        // check if `name` is set
        if ($request->get('name', false) === false)
        {
            return JsonResponse::create([
                'id'      => null,
                'code'    => Create::CODE_NAME_IS_NOT_GIVEN,
                'message' => 'param `name` is required'
            ]);
        }

        // check if `priority` value
        if (!in_array($request->get('priority', 'normal'), ['normal', 'high', 'low']))
        {
            return JsonResponse::create([
                'id'      => null,
                'code'    => Create::CODE_PRIORITY_IS_INVALID,
                'message' => 'param `priority` must be `normal`, `high` or `low`'
            ]);
        }

        // save task
        try {
            $task = new Task();
            $task->name     = $request->get('name');
            $task->marked   = $request->get('marked', false);
            $task->priority = $request->get('priority', Task::PRIORITY_NORMAL);
            $task->cardid   = $request->get('cardId', 1);
            $task->save();

            return JsonResponse::create([
                'id'      => (int) $task->id,
                'code'    => Create::CODE_ALL_FINE,
                'message' => 'all fine'
            ]);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'id'      => null,
                'code'    => Create::CODE_UNKNOWN_ERROR,
                'message' => $e->getMessage()
            ]);
        }
    }

}

