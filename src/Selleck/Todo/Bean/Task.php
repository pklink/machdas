<?php


namespace Selleck\Todo\Bean;


use RedBean_Facade as R;

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


    public static function findAll($table = 'task')
    {
        return parent::findAll($table);
    }

}