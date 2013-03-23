<?php


namespace Selleck\Todo\Action\Task;


use Camspiers\JsonPretty\JsonPretty;
use Selleck\Todo\Action;
use Selleck\Todo\Model\Task;
use Selleck\Todo;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class Add extends Action
{

    public function run()
    {
        $request = Todo::app()->getRequest();

        $task = new Task();
        $task->name = $request->get('name');
        $task->save();

        $return = [
            'id'   => $task->id,
            'name' => $task->name,
        ];

        return JsonResponse::create($return);
    }

}

