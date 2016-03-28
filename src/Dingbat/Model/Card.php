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
 * @property int id
 * @property string name
 * @property int created_at
 * @property int updated_at
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