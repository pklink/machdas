<?php


namespace Dingbat\Model;
use Illuminate\Database\Eloquent\Model;
use Respect\Validation\Validator;


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
     * @return Validator[]
     */
    public static function validators() {
        $priorityList = [self::PRIORITY_LOW, self::PRIORITY_NORMAL, self::PRIORITY_HIGH];

        return [
            'name'     => Validator::stringType()->notEmpty()->setName('name'),
            'marked'   => Validator::boolType()->setName('marked'),
            'priority' => Validator::stringType()->in($priorityList)->setName('priority'),
            'cardId'   => Validator::intType()->notEmpty()->callback(function($v) {
                return Card::query()->find($v) instanceof Card;
            })->setName('cardId')
        ];
    }

    /**
     * @var string
     */
    protected $table = 'tasks';

    /**
     * @var bool
     */
    public $timestamps = false;

}