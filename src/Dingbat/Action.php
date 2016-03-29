<?php


namespace Dingbat;
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
    public function run(Request $request, Response $response, array $args);

}