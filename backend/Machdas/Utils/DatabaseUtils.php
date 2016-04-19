<?php

namespace Machdas\Utils;

class DatabaseUtils
{

    /**
     * @param string $direction
     * @return string
     */
    public static function ensureOrderDirection(string $direction) : string
    {
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
    public static function parseTaskPriority($priority) : int
    {
        switch ($priority) {
            case 'normal':
                $priority = 500;
                break;
            case 'low':
                $priority = 100;
                break;
            case 'high':
                $priority = 900;
        }

        return (int) $priority;
    }
}
