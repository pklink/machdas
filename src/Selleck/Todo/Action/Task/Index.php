<?php


namespace Selleck\Todo\Action\Task;


use Selleck\Todo\Action;
use Selleck\Todo\Model\Task;
use Selleck\Todo;

class Index extends Action
{

    public function get()
    {
        return $this->render('tasks', [
            'tasks' => Task::objects()->fetch(),
        ]);
    }

}

