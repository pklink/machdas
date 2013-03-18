<?php


namespace Selleck\Todo\Action\Task;


use Selleck\Todo\Action;
use Selleck\Todo\Bean\Task;

class Add extends Action
{

    public function get()
    {
        $task = new Task();
        $task->name = 'blbl';
        $task->description = 'desc';
        $task->priority = 4;
        $task->save();

        return $this->render('add', ['id' => $task->id]);
    }

}