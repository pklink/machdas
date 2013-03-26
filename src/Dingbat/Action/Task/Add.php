<?php


namespace Dingbat\Action\Task;


use Dingbat\Action;
use Dingbat\Model\Task;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class Add extends Action
{

    public function run()
    {
        $request = Todo::app()->getRequest();

        $task = new Task();
        $task->name = $request->get('name');
        $task->priority = $request->get('priority', Task::PRIORITY_NORMAL);
        $task->save();

        $return = [
            'id'   => $task->id,
            'name' => $task->name,
        ];

        return JsonResponse::create($return);
    }

}

