<?php


namespace Dingbat\Action\Card;

use Dingbat\Action;
use Dingbat\Model\Card;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Slim\Http\Request;
use Slim\Http\Response;

class GetOne implements Action
{

    public function __invoke(Request $request, Response $response, array $args)
    {
        $id = $args['id'];

        // get card
        try {
            /* @var Card $model */
            $model = Card::query()->findOrFail($id);

            return $response
                ->withJson([
                    'id'   => (int) $model->id,
                    'name' => $model->name,
                ]);
        } catch (ModelNotFoundException $e) {
            // card not fou8nd
            return $response
                ->withStatus(404)
                ->withJson(['message' => 'card does not exist']);
        } catch (\Exception $e) {
            // unexpected error
            return $response
                ->withStatus(500)
                ->withJson(['message' => $e->getMessage()]);
        }
    }

}

