<?php


namespace Dingbat\Action\Task;

use Dingbat\Action;
use Dingbat\Model\Card;
use Dingbat\Model\Task;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class Update
 *
 * @category Action
 * @package  Dingbat\Action\Task
 * @author   Pierre Klink <dev@klinks.info>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://github.com/pklink/Dingbat
 */
class Update extends Action
{

    const CODE_ALL_FINE = 0;
    const CODE_TASK_DOES_NOT_EXIST = 1;
    const CODE_CARD_ID_IS_NOT_GIVEN = 2;
    const CODE_CARD_DOES_NOT_EXIST = 3;
    const CODE_NAME_IS_NOT_GIVEN = 4;
    const CODE_PRIORITY_IS_INVALID = 5;
    const CODE_UNKNOWN_ERROR = 999;


    /**
     * Update a task
     *
     * @param int $id ID of task
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function run($id)
    {
        $request = $this->request;

        /* @var Task $task */
        $task = null;
        try {
            $task = Task::get($id);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'code'    => Update::CODE_TASK_DOES_NOT_EXIST,
                'message' => sprintf('task with `id` `%d` does not exist', $id)
            ]);
        }

        // check if cardId is set
        if ($request->get('cardId', false) === false)
        {
            return JsonResponse::create([
                'code'    => Update::CODE_CARD_ID_IS_NOT_GIVEN,
                'message' => 'param `cardId` is required'
            ]);
        }

        // check if cardId is exist
        if (!Card::exists($request->get('cardId')))
        {
            return JsonResponse::create([
                'code'    => Update::CODE_CARD_DOES_NOT_EXIST,
                'message' => sprintf('card with id `%d` does not exist', $request->get('cardId'))
            ]);
        }

        // check if `name` is set
        if ($request->get('name', false) === false)
        {
            return JsonResponse::create([
                'code'    => Update::CODE_NAME_IS_NOT_GIVEN,
                'message' => 'param `name` is required'
            ]);
        }

        // check if `priority` value
        if (!in_array($request->get('priority', 'normal'), ['normal', 'high', 'low']))
        {
            return JsonResponse::create([
                'code'    => Update::CODE_PRIORITY_IS_INVALID,
                'message' => 'param `priority` must be `normal`, `high` or `low`'
            ]);
        }

        // save task
        try
        {
            $task->name     = $request->get('name');
            $task->marked   = $request->get('marked');
            $task->priority = $request->get('priority', Task::PRIORITY_NORMAL);
            $task->cardid   = $request->get('cardId');
            $task->update();

            return JsonResponse::create([
                'code'    => Update::CODE_ALL_FINE,
                'message' => 'all fine'
            ]);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'code'    => Update::CODE_UNKNOWN_ERROR,
                'message' => $e->getMessage()
            ]);
        }
    }

}

