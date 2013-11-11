<?php


namespace Dingbat\Model;

use Phormium\Model;

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

    const PRIORITY_LOW    = 'low';
    const PRIORITY_NORMAL = 'normal';
    const PRIORITY_HIGH   = 'high';

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
     * @var string
     */
    public $priority = Task::PRIORITY_NORMAL;

    /**
     * @var int
     */
    public $cardid;

}