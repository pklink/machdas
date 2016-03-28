<?php


namespace Dingbat\Model;
use Illuminate\Database\Eloquent\Model;


/**
 * Class Task
 *
 * @category Model
 * @package  Dingbat\Model
 * @author   Pierre Klink <dev@klinks.info>
 * @license  MIT http://opensource.org/licenses/MIT
 * @link     https://github.com/pklink/Dingbat
 *
 * @property int     id
 * @property string  name
 * @property boolean marked
 * @property string  priority
 * @property int     cardId
 */
class Task extends Model
{

    const PRIORITY_LOW    = 'low';
    const PRIORITY_NORMAL = 'normal';
    const PRIORITY_HIGH   = 'high';

    /**
     * @var string
     */
    protected $table = 'tasks';

    /**
     * @var bool
     */
    public $timestamps = false;

}