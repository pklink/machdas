<?php


namespace Dingbat;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * @category Action
 * @package  Dingbat
 * @author   Pierre Klink <dev@klinks.info>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://github.com/pklink/Dingbat
 */
interface Action
{

    public function run(Request $request, Response $response, array $args);

}