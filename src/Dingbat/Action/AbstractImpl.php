<?php

namespace Dingbat\Action;
use Dingbat\Action;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Respect\Validation\Exceptions\NestedValidationException;
use Slim\Http\Request;
use Slim\Http\Response;

abstract class AbstractImpl implements Action
{

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     * @throws NestedValidationException
     * @throws ModelNotFoundException
     */
    public abstract function run(Request $request, Response $response, array $args);

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function __invoke(Request $request, Response $response, array $args)
    {
        try {
            return $this->run($request, $response, $args);
        } catch (NestedValidationException $e) {
            // validation error
            return $response
                ->withStatus(400)
                ->withJson(['message' => $e->getFullMessage()]);
        } catch (ModelNotFoundException $e) {
            // model not found
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