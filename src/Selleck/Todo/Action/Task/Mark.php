<?php


namespace Selleck\Todo\Action\Task;


use Camspiers\JsonPretty\JsonPretty;
use Selleck\Todo\Action;
use Selleck\Todo\Model\Task;
use Selleck\Todo;

class Mark extends Action
{

    public function post()
    {
        /* @var Task $task */
        $task = Task::get(Todo::app()->getRequest()->get('id'));
        $task->marked = !$task->marked;
        $task->save();

        return (new JsonPretty())->prettify(['success' => 1]);
    }

}

