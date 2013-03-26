<?php


namespace Dingbat\Action\Task;


use Dingbat\Action;
use Dingbat\Model\Task;
use Symfony\Component\HttpFoundation\JsonResponse;

class Delete extends Action
{

    public function run($id)
    {
        Task::get($id)->delete();
        return JsonResponse::create(['success' => 1]);
    }

}

