<?php


namespace Selleck\Todo;


use Selleck\Todo;

abstract class Action
{

    /**
     * @param string $template
     * @param array  $data
     */
    protected function render($template, array $data =[])
    {
        return Todo::app()->getSilex()['twig']->render($template . '.twig', $data);
    }

}