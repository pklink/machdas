<?php


namespace Dingbat\Model;


use \Phormium\Model;

class Task extends Model
{

    const PRIORITY_LOW    = 0;
    const PRIORITY_NORMAL = 1;
    const PRIORITY_HIGH   = 2;


    /**
     * @var array
     */
    protected static $_meta = [
        'database' => 'todo',
        'table'    => 'tasks',
        'pk'       => 'id'
    ];


    /**
     * @var int
     */
    public $id;


    /**
     * @var string
     */
    public $name;


    /**
     * @var boolean
     */
    public $marked = false;


    /**
     * @var int
     */
    public $priority = self::PRIORITY_NORMAL;

}