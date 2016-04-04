<?php


namespace Machdas\Action\Card;

use Machdas\Action;
use Machdas\Model\Card;
use Machdas\Model\Task;
use Machdas\Utils\DatabaseUtils;
use Slim\Http\Request;
use Slim\Http\Response;

class GetAllTasks extends Action\AbstractImpl
{

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function run(Request $request, Response $response, array $args) : Response
    {
        // get card
        /* @var Card $card */
        $card = Card::query()->findOrFail($args['id']);

        /** @noinspection PhpUndefinedMethodInspection */
        $builder = Task::query()->where('cardId', '=', $card->id);

        // sorting
        if (!is_null($request->getParam('order-by'))) {
            list($attribute, $direction) = explode(',', $request->getParam('order-by'));
            $direction = DatabaseUtils::ensureOrderDirection($direction);

            // check if attribute is valid
            if (!in_array($attribute, ['priority', 'name', 'isDone'])) {
                $attribute = 'id';
            }

            /** @noinspection PhpUndefinedMethodInspection */
            $builder->orderBy($attribute, $direction);
        } else {
            /** @noinspection PhpUndefinedMethodInspection */
            $builder->orderBy('id', 'desc');
        }

        return $response->withJson($builder->get());
    }

}

