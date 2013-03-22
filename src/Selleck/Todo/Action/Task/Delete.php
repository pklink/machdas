<?php


namespace Selleck\Todo\Action\Task;


use Camspiers\JsonPretty\JsonPretty;
use Selleck\Todo\Action;
use Selleck\Todo\Model\Task;
use Selleck\Todo;

class Delete extends Action
{

    public function post()
    {
        $success = true;

        Task::get(Todo::app()->getRequest()->get('id'))->delete();

        return (new JsonPretty())->prettify(['success' => 1]);
    }

}

