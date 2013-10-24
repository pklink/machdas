<?php


namespace Dingbat\Model;

use \Phormium\Model;

/**
 * Class Task
 *
 * @category Model
 * @package  Dingbat\Model
 * @author   Pierre Klink <dev@klinks.info>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://github.com/pklink/Dingbat
 */
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

    /**
     * @var int
     */
    public $cardid;

}