<?php declare(strict_types=1);

namespace AlecRabbit\Cli\Tools;

use const AlecRabbit\ESC;

class Line
{
    /**
     * Clears screen
     *
     * @return string
     */
    public static function eraseToEnd(): string
    {
        return ESC . '[K';
    }
}
