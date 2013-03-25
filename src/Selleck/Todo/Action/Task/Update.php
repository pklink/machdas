<?php


namespace Selleck\Todo\Action\Task;


use Selleck\Todo\Action;
use Selleck\Todo\Model\Task;
use Selleck\Todo;
use Symfony\Component\HttpFoundation\JsonResponse;

class Update extends Action
{

    public function run($id)
    {
        $request = Todo::app()->getRequest();

        /* @var Task $task */
        $task = Task::get($id);
        $task->name   = $request->get('name');
        $task->marked = $request->get('marked');
        $task->update();

        return JsonResponse::create(['success' => 1]);
    }

}

