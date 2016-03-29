<?php


namespace Dingbat\Model;

use Illuminate\Database\Eloquent\Model;


/**
 * @property int    id
 * @property string name
 */
class Card extends Model
{

    /**
     * @var string
     */
    protected $table = 'cards';

    /**
     * @var bool
     */
    public $timestamps = false;

}