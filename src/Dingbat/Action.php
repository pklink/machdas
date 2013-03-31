<?php


namespace Dingbat;

use Symfony\Component\HttpFoundation\Request;

/**
 * Class Action
 *
 * @category Action
 * @package  Dingbat
 * @author   Pierre Klink <dev@klinks.info>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://github.com/pklink/Dingbat
 *
 * @method run
 */
abstract class Action
{

    /**
     * @var Request
     */
    protected $request;


    /**
     * @param Request $request
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

}