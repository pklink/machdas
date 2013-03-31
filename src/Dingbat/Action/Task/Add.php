<?php


namespace Dingbat\Action\Task;

use Dingbat\App;
use Dingbat\Action;
use Dingbat\Model\Task;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

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

        $task = new Task();
        $task->name     = $request->get('name');
        $task->marked   = $request->get('marked', false);
        $task->priority = $request->get('priority', Task::PRIORITY_NORMAL);
        $task->save();

        $return = [
            'id'   => $task->id,
            'name' => $task->name,
        ];

        return JsonResponse::create($return);
    }

}

