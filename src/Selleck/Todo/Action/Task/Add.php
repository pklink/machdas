<?php


namespace Selleck\Todo\Action\Task;


use Camspiers\JsonPretty\JsonPretty;
use Selleck\Todo\Action;
use Selleck\Todo\Model\Task;
use Selleck\Todo;

class Add extends Action
{

    public function post()
    {
        $request = Todo::app()->getRequest();

        $task = new Task();
        $task->name = $request->get('name');
        $task->save();

        $return = [
            'id'   => $task->id,
            'name' => $task->name,
        ];

        return (new JsonPretty())->prettify($return);
    }

}

