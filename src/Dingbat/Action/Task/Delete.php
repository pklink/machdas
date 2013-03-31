<?php


namespace Dingbat\Action\Task;

use Dingbat\Action;
use Dingbat\Model\Task;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class Delete
 *
 * @category Action
 * @package  Dingbat\Action\Task
 * @author   Pierre Klink <dev@klinks.info>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://github.com/pklink/Dingbat
 */
class Delete extends Action
{

    /**
     * Remove task with ID $id
     *
     * @param integer $id ID of task
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function run($id)
    {
        Task::get($id)->delete();
        return JsonResponse::create(['success' => 1]);
    }

}

