<?php


namespace Dingbat\Action\Task;

use Dingbat\App;
use Dingbat\Action;
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

    /**
     * Update a task
     *
     * @param int $id ID of task
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function run($id)
    {
        $request = $this->request;

        /* @var Task $task */
        $task = Task::get($id);
        $task->name     = $request->get('name');
        $task->marked   = $request->get('marked');
        $task->priority = $request->get('priority', Task::PRIORITY_NORMAL);
        $task->cardid   = $request->get('cardId');
        $task->update();

        return JsonResponse::create(['success' => 1]);
    }

}

