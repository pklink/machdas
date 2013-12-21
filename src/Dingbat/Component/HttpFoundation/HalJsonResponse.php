<?php

namespace Dingbat\Component\HttpFoundation;

use Nocarrier\Hal;
use Symfony\Component\HttpFoundation\Response;

class HalJsonResponse extends Response
{

    public static function create($content = '', $status = 200, $headers = array())
    {
        if (!($content instanceof Hal))
        {
            throw new \Exception('`$content` mus be an instance of `\\Nocarrier\\Hal`');
        }

        $headers = array_merge($headers, ['Content-Type' => 'application/hal+json']);
        return parent::create($content->asJson(), $status, $headers);
    }

}