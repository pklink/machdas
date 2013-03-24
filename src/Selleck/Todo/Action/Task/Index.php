<?php


namespace Selleck\Todo\Action\Task;


use Selleck\Todo\Action;
use Selleck\Todo\Model\Task;
use Selleck\Todo;
use Symfony\Component\HttpFoundation\JsonResponse;

class Index extends Action
{

    public function run()
    {
        sleep(1);
        $tasks = [];
        foreach (Task::objects()->orderBy('id', 'asc')->fetch() as $task) {
            $tasks[] = [
                'id'     => $task->id,
                'name'   => $task->name,
                'marked' => $task->marked
            ];
        }

        return JsonResponse::create($tasks);
    }

}

