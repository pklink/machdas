<?php


namespace Dingbat\Action\Task;

use Dingbat\Action;
use Dingbat\Model\Task;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Slim\Http\Request;
use Slim\Http\Response;

class GetOne implements Action
{

    public function __invoke(Request $request, Response $response, array $args)
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
                'priority' => $task->priority
            ]);
        } catch (ModelNotFoundException $e) {
            return $response
                ->withStatus(404)
                ->withJson(['message'  => sprintf('task with `id` `%s` does not exist', $id)]);
        } catch (\Exception $e) {
            return $response
                ->withStatus(500)
                ->withJson(['message'  => $e->getMessage()]);
        }
    }

}

