<?php


namespace Dingbat\Action\Task;

use Dingbat\Action;
use Dingbat\Model\Task;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class Index
 *
 * @category Action
 * @package  Dingbat\Action\Task
 * @author   Pierre Klink <dev@klinks.info>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://github.com/pklink/Dingbat
 */
class GetAll extends Action
{

    /**
     * @param string $filter attribute=value;otherattribute=value
     * @return \Symfony\Component\HttpFoundation\Response|static
     */
    public function run($filter = null)
    {
        $objects = Task::objects();

        // filter
        if ($filter != null)
        {
            $conditions = explode(';', $filter);

            foreach ($conditions as $condition)
            {
                $splits = explode('=', $condition);

                if (!isset($splits[1])) {
                    continue;
                }

                $attribute = $splits[0];
                $value     = $splits[1];

                switch ($attribute)
                {
                    case 'id':
                    case 'priority':
                    case 'cardid':
                        $objects = $objects->filter($attribute, '=', $value);
                        break;

                    case 'marked':
                        $value = ($value == 'true' ? true : false);
                        $objects = $objects->filter($attribute, '=', $value);
                        break;

                    case 'name':
                        $objects = $objects->filter($attribute, 'LIKE', '%' . $value . '%');
                        break;
                }
            }
        }

        $tasks = [];
        foreach ($objects->orderBy('id', 'asc')->fetch() as $task) {
            $tasks[] = [
                'id'       => (int) $task->id,
                'name'     => $task->name,
                'marked'   => (bool) $task->marked,
                'priority' => $task->priority,
                'cardId'   => (int) $task->cardid
            ];
        }

        return JsonResponse::create($tasks);
    }

}

