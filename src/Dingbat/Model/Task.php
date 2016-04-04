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

    /**
     * @return Validator[]
     */
    public static function validators() {
        return [
            'name'     => Validator::stringType()->notEmpty()->setName('name'),
            'marked'   => Validator::boolType()->setName('marked'),
            'priority' => Validator::intType()->between(1, 999)->setName('priority'),
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