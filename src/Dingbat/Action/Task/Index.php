<?php


namespace Dingbat\Action\Task;


use Dingbat\Action;
use Dingbat\Model\Task;
use Symfony\Component\HttpFoundation\JsonResponse;

class Index extends Action
{

    public function run()
    {
        $tasks = [];
        foreach (Task::objects()->orderBy('id', 'asc')->fetch() as $task) {
            $tasks[] = [
                'id'       => $task->id,
                'name'     => $task->name,
                'marked'   => $task->marked,
                'priority' => $task->priority
            ];
        }

        return JsonResponse::create($tasks);
    }

}

