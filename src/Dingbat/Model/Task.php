<?php


namespace Dingbat\Model;
use Illuminate\Database\Eloquent\Model;


/**
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