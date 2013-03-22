<?php


namespace Selleck\Todo\Model;


use \Phormium\Model;
use Selleck\Todo;

class Task extends Model
{

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

}