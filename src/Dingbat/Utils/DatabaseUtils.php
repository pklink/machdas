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

    /**
     * @param string|int $priority
     * @return int
     */
    public static function parseTaskPriority($priority) {
        switch ($priority) {
            case 'normal': $priority = 500; break;
            case 'low':    $priority = 100; break;
            case 'high':   $priority = 900; break;
        }

        return (int) $priority;
    }

}