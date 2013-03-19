<?php


namespace Selleck\Todo\Action\Task;


use Camspiers\JsonPretty\JsonPretty;
use Selleck\Todo\Action;
use Selleck\Todo\Bean\Task;
use Selleck\Todo;

class Index extends Action
{

    public function get()
    {
        /*
        $task = new Task();
        $task->name = 'blbl';
        $task->description = 'desc';
        $task->priority = 4;
        $task->save();
        */

        $request = Todo::app()->getRequest();

        // form was submitted
        if (Todo::app()->getRequest()->isMethod('POST'))
        {
            $task = new Task();
            $task->name        = $request->get('name');
            $task->description = $request->get('description');
            $task->save();
        }

        if ($request->isXmlHttpRequest())
        {
            $return = [
                'id'          => $task->id,
                'name'        => $task->name,
                'description' => $task->description
            ];

            return (new JsonPretty())->prettify($return);
        }
        else
        {
            return $this->render('tasks', [
                'tasks' => Task::findAll(),
            ]);
        }
    }

}

