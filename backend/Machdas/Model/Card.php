<?php

namespace Machdas\Model;

use Illuminate\Database\Eloquent\Model;
use Respect\Validation\Validator;

/**
 * @property int    $id
 * @property string $name
 */
class Card extends Model
{

    /**
     * @return Validator[]
     */
    public static function validators() : array
    {
        return [
            'name' => Validator::stringType()->notEmpty()->setName('name')
        ];
    }

    /**
     * @var string
     */
    protected $table = 'cards';

    /**
     * @var bool
     */
    public $timestamps = false;
}
