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
        $request = Todo::app()->getRequest();

        // form submitted
        if ($request->isMethod('POST') && $request->get('do') == 'save')
        {
            // save task
            if ($request->get('do') == 'save')
            {
                $task = new Task();
                $task->name        = $request->get('name');
                $task->save();
            }

            // mark task
            else
            {

            }
        }



        // ajax-response
        if ($request->isXmlHttpRequest())
        {
            $return = [
                'id'          => $task->id,
                'name'        => $task->name,
            ];

            return (new JsonPretty())->prettify($return);
        }
        // "normal" response
        else
        {
            return $this->render('tasks', [
                'tasks' => Task::findAll(),
            ]);
        }
    }

}

