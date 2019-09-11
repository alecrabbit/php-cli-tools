<?php declare(strict_types=1);

namespace AlecRabbit\Cli\Tools\Core;

use const AlecRabbit\ENV_COLORTERM;
use const AlecRabbit\ENV_DOCKER_TERM;
use const AlecRabbit\ENV_TERM;
use const AlecRabbit\NEEDLE_256_COLOR;
use const AlecRabbit\NEEDLE_TRUECOLOR;
use const AlecRabbit\XTERM;

abstract class AbstractColorSupportingTerminal extends AbstractTerminal
{

    /** @var null|bool */
    protected static $supports256Color;

    /** @var null|bool */
    protected static $supportsTrueColor;

    /** @var null|bool */
    protected static $supportsColor;

    /** @var null|bool */
    protected static $isXterm;

    /**
     * @return bool
     */
    protected static function isXterm(): bool
    {
        if (null !== static::$isXterm) {
            return static::$isXterm;
        }
        return
            static::$isXterm = static::isXtermTerminal();
    }

    /**
     * @return bool
     */
    protected static function isXtermTerminal(): bool
    {
        return
            static::checkEnvVariable(ENV_TERM, XTERM) ||
            static::checkEnvVariable(ENV_DOCKER_TERM, XTERM);
    }

    /**
     * @param string $varName
     * @param string $checkFor
     * @return bool
     */
    protected static function checkEnvVariable(string $varName, string $checkFor): bool
    {
        if ($t = getenv($varName)) {
            return
                false !== strpos($t, $checkFor);
        }
        return false;
    }

    /**
     * @return bool
     */
    protected static function has256ColorSupport(): bool
    {
        return
            static::supportsColor() ?
                static::checkEnvVariable(ENV_TERM, NEEDLE_256_COLOR) ||
                static::checkEnvVariable(ENV_DOCKER_TERM, NEEDLE_256_COLOR) :
                false;
    }

    protected static function hasTrueColorSupport(): bool
    {
        return
            static::supportsColor() ?
                static::checkEnvVariable(ENV_COLORTERM, NEEDLE_TRUECOLOR) :
                false;
    }

    /**
     * @param bool $recheck
     * @param null|bool|resource $stream
     * @return bool
     */
    abstract public static function supportsColor(bool $recheck = false, $stream = null): bool;
}
