<?php
/**
 * Created by IntelliJ IDEA.
 * User: pierre
 * Date: 20.11.13
 * Time: 22:28
 * To change this template use File | Settings | File Templates.
 */

namespace Dingbat\Helper;


class SlugHelper
{

    /**
     * remove invalid characters
     *
     * @param string $slug
     * @return mixed
     */
    public static function convert($slug)
    {
        // remove invalid character from slug
        for ($i = 0; $i < strlen($slug); $i++)
        {
            if (preg_match('/[a-z\d\-\+]/', $slug{$i}) === 0)
            {
                $slug{$i} = chr(0);
            }
        }

        return str_replace(chr(0), '', $slug); // remove all NULs
    }

}