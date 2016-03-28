<?php


namespace Dingbat\Action\Task;

use Dingbat\Action;
use Dingbat\Model\Task;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class Get
 *
 * @category Action
 * @package  Dingbat\Action\Task
 * @author   Pierre Klink <dev@klinks.info>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://github.com/pklink/Dingbat
 */
class GetOne extends Action
{

    const CODE_ALL_FINE = 0;
    const CODE_TASK_DOES_NOT_EXIST = 1;


    public function run(Request $request, Response $response, array $args)
    {
        $id = $args['id'];

        // get task
        try {
            /* @var Task $task */
            $task = Task::query()->findOrFail($id);

            return $response->withJson([
                'id'       => (int) $task->id,
                'cardId'   => (int) $task->cardId,
                'name'     => $task->name,
                'marked'   => (bool) $task->marked,
                'priority' => $task->priority,
                'code'     => GetOne::CODE_ALL_FINE,
                'message'  => 'all fine'
            ]);
        } catch (\Exception $e) {
            return $response->withStatus(404)->withJson([
                'code'     => GetOne::CODE_TASK_DOES_NOT_EXIST,
                'message'  => sprintf('task with `id` `%s` does not exist', $id)
            ]);
        }
    }

}

