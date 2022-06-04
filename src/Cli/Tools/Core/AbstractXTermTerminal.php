<?php declare(strict_types=1);

namespace AlecRabbit\Cli\Tools\Core;

use AlecRabbit\Cli\Tools\EnvCheck;

abstract class AbstractXTermTerminal extends AbstractTerminal
{
    protected static ?bool $isXterm;

    protected static function isXterm(): bool
    {
        return
            static::$isXterm ?? (static::$isXterm = EnvCheck::isXTerm());
    }
}
