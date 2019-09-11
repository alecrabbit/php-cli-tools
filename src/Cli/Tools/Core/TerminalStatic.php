<?php declare(strict_types=1);

namespace AlecRabbit\Cli\Tools\Core;

use AlecRabbit\Cli\Tools\Core\Contracts\TerminalStaticInterface;
use const AlecRabbit\COLOR256_TERMINAL;
use const AlecRabbit\COLOR_TERMINAL;
use const AlecRabbit\NO_COLOR_TERMINAL;

/**
 * Class Terminal
 * @author AlecRabbit
 */
class TerminalStatic extends AbstractColorSupportingTerminal implements TerminalStaticInterface
{

    /** {@inheritdoc} */
    public static function supports256Color(bool $recheck = false): bool
    {
        if (null !== static::$supports256Color && true !== $recheck) {
            return static::$supports256Color;
        }
        return
            static::$supports256Color = static::has256ColorSupport();
    }

    /** {@inheritdoc} */
    public static function supportsColor(bool $recheck = false, $stream = null): bool
    {
        if (null !== static::$supportsColor && false === $recheck) {
            return static::$supportsColor;
        }
        return
            static::$supportsColor = static::hasColorSupport($stream);
    }

    /** {@inheritdoc} */
    public static function setTitle(string $title): string
    {
        if (static::isXterm()) {
            return "\033]0;{$title}\007";
        }
        // @codeCoverageIgnoreStart
        return (string)null;
        // @codeCoverageIgnoreEnd
    }

    /** {@inheritdoc} */
    public static function width(bool $recheck = false): int
    {
        if (null !== static::$width && true !== $recheck) {
            return static::$width;
        }
        return
            static::$width = static::getWidth();
    }

    /** {@inheritdoc} */
    public static function height(bool $recheck = false): int
    {
        if (null !== static::$height && true !== $recheck) {
            return static::$height;
        }
        return
            static::$height = static::getHeight();
    }

    /** {@inheritdoc} */
    public static function colorSupport($stream = null): int
    {
        if (static::supportsColor(false, $stream)) {
            return
                static::supports256Color() ?
                    COLOR256_TERMINAL :
                    COLOR_TERMINAL;
        }
        // @codeCoverageIgnoreStart
        return NO_COLOR_TERMINAL;
        // @codeCoverageIgnoreEnd
    }
}
