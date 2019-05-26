<?php declare(strict_types=1);

namespace AlecRabbit\Cli\Tools;

use const AlecRabbit\ESC;

class Screen
{
    /**
     * Clears screen
     *
     * @return string
     */
    public static function clear(): string
    {
        return ESC . '[2J';
    }

    /**
     * Clears screen
     *
     * @return string
     */
    public static function eraseToCursor(): string
    {
        return ESC . '[1J';
    }

    /**
     * Clears screen
     *
     * @return string
     */
    public static function eraseFromCursor(): string
    {
        return ESC . '[0J';
    }
}
