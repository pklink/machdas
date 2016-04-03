<?php

namespace Dingbat\Utils;


class DatabaseUtils
{

    /**
     * @param string $direction
     * @return string
     */
    public static function ensureOrderDirection($direction) {
        $direction = strtolower($direction);

        if (!in_array($direction, ['asc', 'desc'])) {
            $direction = 'asc';
        }

        return $direction;
    }

}