<?php


namespace Dingbat\Action\Task;


use Dingbat\App;
use Dingbat\Action;
use Dingbat\Model\Task;
use Symfony\Component\HttpFoundation\JsonResponse;

class Update extends Action
{

    public function run($id)
    {
        $request = App::instance()->getRequest();

        /* @var Task $task */
        $task = Task::get($id);
        $task->name     = $request->get('name');
        $task->marked   = $request->get('marked');
        $task->priority = $request->get('priority', Task::PRIORITY_NORMAL);
        $task->update();

        return JsonResponse::create(['success' => 1]);
    }

}

