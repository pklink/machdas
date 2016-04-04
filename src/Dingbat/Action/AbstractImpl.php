<?php

namespace Dingbat\Action;
use Dingbat\Action;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Respect\Validation\Exceptions\NestedValidationException;
use Slim\Exception\NotFoundException;
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
    abstract public function run(Request $request, Response $response, array $args) : Response;

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     * @throws NotFoundException
     */
    public function __invoke(Request $request, Response $response, array $args) : Response
    {
        try {
            return $this->run($request, $response, $args);
        } catch (NestedValidationException $e) {
            // validation error
            return $response
                ->withStatus(400)
                ->withJson(['message' => $e->getFullMessage()]);
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException($request, $response);
        }
    }

}