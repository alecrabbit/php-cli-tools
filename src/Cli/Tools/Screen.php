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
}
