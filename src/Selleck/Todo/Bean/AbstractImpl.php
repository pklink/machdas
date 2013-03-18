<?php


namespace Selleck\Todo\Bean;


use RedBean_Facade as R;

/**
 * @property integer $id
 */
class AbstractImpl
{

    /**
     * @var \RedBean_Facade;
     */
    protected $bean;


    /**
     * @param $name
     */
    public function __construct($name)
    {
        $this->bean = R::dispense($name);
    }


    /**
     * @param mixed
     */
    function __get($name)
    {
        return $this->bean->$name;
    }


    /**
     * @param string $name
     * @param mixed $value
     */
    function __set($name, $value)
    {
        $this->bean->$name = $value;
    }


    /**
     * @return void
     */
    public function save()
    {
        $this->id = R::store($this->bean);
    }

}