<?php


namespace Dingbat\Action\Task;

use Dingbat\Action;
use Dingbat\Model\Task;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class Get
 *
 * @category Action
 * @package  Dingbat\Action\Task
 * @author   Pierre Klink <dev@klinks.info>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://github.com/pklink/Dingbat
 */
class GetOne extends Action
{

    const CODE_ALL_FINE = 0;
    const CODE_TASK_DOES_NOT_EXIST = 1;


    /**
     * Update a task
     *
     * @param int $id ID of task
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function run($id)
    {
        // get task
        try {
            /* @var Task $task */
            $task = Task::get($id);

            return JsonResponse::create([
                'id'       => (int) $task->id,
                'cardId'   => (int) $task->cardid,
                'name'     => $task->name,
                'marked'   => (bool) $task->marked,
                'priority' => $task->priority,
                'code'     => GetOne::CODE_ALL_FINE,
                'message'  => 'all fine'
            ]);
        } catch (\Exception $e) {
            return JsonResponse::create([
                'id'       => null,
                'cardId'   => null,
                'name'     => null,
                'marked'   => null,
                'priority' => null,
                'code'     => GetOne::CODE_TASK_DOES_NOT_EXIST,
                'message'  => sprintf('task with `id` `%s` does not exist', $id)
            ]);
        }

    }

}

