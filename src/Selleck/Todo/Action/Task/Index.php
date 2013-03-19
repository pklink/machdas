<?php


namespace Selleck\Todo\Action\Task;


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

        // form was submitted
        if (Todo::app()->getRequest()->isMethod('POST'))
        {
            $request = Todo::app()->getRequest();

            $task = new Task();
            $task->name        = $request->get('name');
            $task->description = $request->get('description');
            $task->save();
        }

        return $this->render('tasks', [
            'tasks' => Task::findAll(),
        ]);
    }

}

