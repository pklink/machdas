<?php

namespace Machdas;

use Slim\Http\Request;
use Slim\Http\Response;

interface Action
{

    /**
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     * @return Response
     */
    public function __invoke(Request $request, Response $response, array $args) : Response;
}
