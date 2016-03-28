<?php


namespace Dingbat\Action\Task;

use Dingbat\Action;
use Dingbat\Model\Task;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class Index
 *
 * @category Action
 * @package  Dingbat\Action\Task
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
        $tasks = [];
        foreach (Task::query()->orderBy('id', 'asc')->get() as $task) {
            $tasks[] = [
                'id'       => (int) $task->id,
                'name'     => $task->name,
                'marked'   => (bool) $task->marked,
                'priority' => $task->priority,
                'cardId'   => (int) $task->cardId
            ];
        }

        return JsonResponse::create($tasks);
    }

}

