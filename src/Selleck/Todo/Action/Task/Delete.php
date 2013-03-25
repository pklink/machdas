<?php


namespace Selleck\Todo\Action\Task;


use Selleck\Todo\Action;
use Selleck\Todo\Model\Task;
use Selleck\Todo;
use Symfony\Component\HttpFoundation\JsonResponse;

class Delete extends Action
{

    public function run($id)
    {
        Task::get($id)->delete();
        return JsonResponse::create(['success' => 1]);
    }

}

