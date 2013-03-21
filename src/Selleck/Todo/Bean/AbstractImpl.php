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
     * @param string $table
     * @param int $id
     * @return AbstractImpl
     */
    public static function find($table, $id)
    {
        $bean = new static($table);
        $bean->setBean( R::load($table, $id) );
        return $bean;
    }


    /**
     * @param string $table
     * @return \RedBean_OODBBean[]
     */
    public static function findAll($table)
    {
        return R::findAll($table, 'ORDER BY id DESC');
    }


    /**
     * @return void
     */
    public function save()
    {
        /* @var \RedBean_SimpleModel $bean */
        $bean = $this->bean;
        $this->id = R::store($bean);
    }


    /**
     * @param $bean
     */
    public function setBean($bean)
    {
        $this->bean = $bean;
    }

}