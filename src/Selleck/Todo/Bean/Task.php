<?php


namespace Selleck\Todo\Bean;

/**
 * @property integer $id
 * @property string  $name
 * @property string  $description
 * @property integer $priority
 */
class Task extends AbstractImpl
{

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct('task');
    }

}